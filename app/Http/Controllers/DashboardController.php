<?php

namespace App\Http\Controllers;

use App\Charts\SalesDailyChart;
use App\Models\Barang;
use App\Models\Salesman;
use App\Models\Transaksi;
use App\Models\Transaksi_Barang;
use App\Services\GoogleSheetsService;
use Carbon\Carbon;
use marineusde\LarapexCharts\Charts\BarChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $googleSheets;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheets = $googleSheetsService;
    }

    public function getSalesmanData($all, $grouped = false) {
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

        $range = 'A2:FL6000';

        if ($all) {
            $salesData = $this->googleSheets->getSpreadsheetValues($sheet.$range);
        }
        else {
            if ($grouped) {
                $salesData = $this->googleSheets->getSelectedColumnsGrouped($sheet.$range, $columns);
            }
            else {
                $salesData = $this->googleSheets->getSelectedColumns($sheet.$range, $columns);
            }
        }

        return $salesData;
    }

    public function upDatabase() {
        $salesData = $this->getSalesmanData(true);
        $salesDataCount = count($salesData);

        for ($i = 0; $i < $salesDataCount; $i++) {
            // If the row is empty, skip
            if (!$salesData[$i]) {
                continue;
            }

            // Get salesman by name
            $salesman = Salesman::where('nama', $salesData[$i][2])->first();
            // If not in database, save it
            if (!$salesman) {
                $salesman = Salesman::create(['nama' => $salesData[$i][2]]);
            }

            // Get transaction by code
            $transaksi = Transaksi::where('kode_transaksi', $salesData[$i][0])->first();
            // If it's already exist, skip current iteration
            if ($transaksi) {
                continue;
            }

            // Else, save it
            $transaksi = Transaksi::create([
                'kode_transaksi' => $salesData[$i][0],
                'id_salesman' => $salesman->id_salesman ?? $salesman->id,
                'tanggal' => Carbon::createFromFormat('d/m/Y H.i.s', $salesData[$i][4])->format('Y/m/d H:i:s')
            ]);

            // Loops over the items that the salesman sold
            $itemCount = 3;
            for ($j = 0; $j < $itemCount; $j++) {
                $counter = 8 * $j;
                // If there's no item left, stop the loop
                if (!$salesData[$i][8 + $counter]) {
                    break;
                }
                // Get item by code
                $barang = Barang::where('kode_barang', $salesData[$i][8 + $counter])->first();
                // If not in database, save it
                if (!$barang) {
                    $barang = Barang::create([
                        'kode_barang' => $salesData[$i][8 + $counter],
                        'nama' => $salesData[$i][9 + $counter],
                        'harga' => $salesData[$i][11 + $counter],
                    ]);
                }

                // If there's changes in price
                if ($salesData[$i][12 + $counter] == 'Ya' && $salesData[$i][13 + $counter]) {
                    $salesData[$i][12 + $counter] = true; // change value to bool
                }
                // If there's no changes in price
                else {
                    $salesData[$i][12 + $counter] = false; // change value to bool
                    $salesData[$i][13 + $counter] = null; // change price to null
                }
                // Create transaction detail
                Transaksi_Barang::create([
                    'id_transaksi' => $transaksi->id_transaksi ?? $transaksi->id,
                    'id_barang' => $barang->id_barang ?? $barang->id,
                    'kuantitas' => $salesData[$i][10 + $counter],
                    'negosiasi' => $salesData[$i][12 + $counter],
                    'harga_nego' => $salesData[$i][13 + $counter],
                    'total' => $salesData[$i][14 + $counter],
                    'keterangan' => $salesData[$i][15 + $counter]
                ]);
            }
        }
    }

    public function index(Request $request) {
        $this->upDatabase();
        // return response()->json($this->getSalesmanData(true));

        // $salesData = $this->getSalesmanData(true);
        // // return response()->json($salesData);

        // $salesChart = SalesDailyChart::build();
        // $salesChart
        // ->setSubtitle('Awikwok')
        // ->setStacked(true)
        // ->addData('Money', $salesData[5])
        // ->addData('Money 2', $salesData[10])
        // ->setXAxis($salesData[0]);


        // We have to format the data somehow so that it could be processed like this :
        $chart = (new BarChart)
            ->setTitle('Sales Data by Product Type')
            ->setSubtitle('Each color represents a different product')
            ->addData('Product A', [10, 0, 10, 0])
            ->addData('Product B', [20, 0, 5, 10])
            ->addData('Product C', [0, 30, 15, 5])
            ->setXAxis(['p1', 'p2', 'p3', 'p4'])
            ->setColors(['#FF5733', '#33FF57', '#3357FF'])
            ->setStacked(true);

        return view('pages.dashboard', ['chart' => $chart, 'currentPage' => 'dashboard']);
    }
}
