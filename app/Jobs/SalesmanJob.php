<?php

namespace App\Jobs;

use App\Models\Barang;
use App\Models\Salesman;
use App\Models\Transaksi;
use App\Models\Transaksi_Barang;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalesmanJob implements ShouldQueue
{
    use Queueable;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $dataCount = count($this->data);

        for ($i = 0; $i < $dataCount; $i++) {
            // If the row is empty, skip
            if (!$this->data[$i]) {
                continue;
            }

            // Get salesman by name
            $salesman = Salesman::where('nama', $this->data[$i][2])->first();
            // If not in database, save it
            if (!$salesman) {
                $salesman = Salesman::create(['nama' => $this->data[$i][2]]);
            }

            // Get transaction by code
            $transaksi = Transaksi::where('kode_transaksi', $this->data[$i][0])->first();
            // If it's already exist, skip current iteration
            if ($transaksi) {
                continue;
            }

            // Else, save it
            $transaksi = Transaksi::create([
                'kode_transaksi' => $this->data[$i][0],
                'id_salesman' => $salesman->id_salesman ?? $salesman->id,
                'tanggal' => Carbon::createFromFormat('d/m/Y H.i.s', $this->data[$i][4])->format('Y/m/d H:i:s')
            ]);

            // Loops over the items that the salesman sold
            $itemCount = 19;
            for ($j = 0; $j < $itemCount; $j++) {
                $counter = 8 * $j;
                // If there's no item left, stop the loop
                if (!$this->data[$i][8 + $counter]) {
                    break;
                }
                // Get item by code
                $barang = Barang::where('kode_barang', $this->data[$i][8 + $counter])->first();
                // If not in database, save it
                if (!$barang) {
                    $barang = Barang::create([
                        'kode_barang' => $this->data[$i][8 + $counter],
                        'nama' => $this->data[$i][9 + $counter],
                        'harga' => $this->data[$i][11 + $counter],
                    ]);
                }

                // If there's changes in price
                if ($this->data[$i][12 + $counter] == 'Ya' && $this->data[$i][13 + $counter]) {
                    $this->data[$i][12 + $counter] = true; // change value to bool
                }
                // If there's no changes in price
                else {
                    $this->data[$i][12 + $counter] = false; // change value to bool
                    $this->data[$i][13 + $counter] = null; // change price to null
                }
                // Create transaction detail
                Transaksi_Barang::create([
                    'id_transaksi' => $transaksi->id_transaksi ?? $transaksi->id,
                    'id_barang' => $barang->id_barang ?? $barang->id,
                    'kuantitas' => $this->data[$i][10 + $counter],
                    'negosiasi' => $this->data[$i][12 + $counter],
                    'harga_nego' => $this->data[$i][13 + $counter],
                    'total' => $this->data[$i][14 + $counter],
                    'keterangan' => $this->data[$i][15 + $counter]
                ]);
            }
        }
    }
}
