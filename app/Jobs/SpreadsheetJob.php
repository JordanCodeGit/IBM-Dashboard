<?php

namespace App\Jobs;

use App\Models\Settings;
use App\Services\GoogleSheetsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SpreadsheetJob implements ShouldQueue
{
    use Queueable;

    protected $all;
    protected $grouped;

    /**
     * Create a new job instance.
     */
    public function __construct($getAll, $grouped = false)
    {
        $this->all = $getAll;
        $this->grouped = $grouped;
    }

    /**
     * Execute the job.
     */
    public function handle(GoogleSheetsService $googleSheetsService): void
    {
        $sheet = 'INPUT SALESMAN!';
        $columns = [
            'A', // Kode transaksi
            'C', // Nama salesman
            'E', // Tanggal
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // Kode barang, Nama barang, Qty. , Harga satuan, Nego, HN, Harga total, Ket.
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X',
            'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF'
        ];

        // A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P
        // 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 1, 2, 3, 4, 5

        $range = 'A2:FL';

            if ($this->all) {
                $salesData = $googleSheetsService->getSpreadsheetValues($sheet.$range);
            }
            else {
                if ($this->grouped) {
                    $salesData = $googleSheetsService->getSelectedColumnsGrouped($sheet.$range, $columns);
                }
                else {
                    $salesData = $googleSheetsService->getSelectedColumns($sheet.$range, $columns);
                }
            }

        $salesDataChunk = array_chunk($salesData, 100);
        for ($i = 0; $i < count($salesDataChunk); $i++) {
            $job = new SalesmanJob($salesDataChunk[$i]);
            dispatch($job);
        }

        // $lastRowIndex = (count($salesDataChunk) - 1) * 1000 + count(end($salesDataChunk)) + 1;
        $lastRowIndex = count($salesData);
        Settings::create([
            'key' => 'LAST_ROW',
            'value' => (string) $lastRowIndex
        ]);
    }
}
