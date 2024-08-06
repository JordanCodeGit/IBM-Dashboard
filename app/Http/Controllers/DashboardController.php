<?php

namespace App\Http\Controllers;

use App\Charts\SalesDailyChart;
use App\Services\GoogleSheetsService;
use marineusde\LarapexCharts\Charts\BarChart;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $googleSheets;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheets = $googleSheetsService;
    }

    public function index(Request $request) {
        $sheet = 'INPUT SALESMAN!';
        $columns = [
            'C', // Nama salesman
            'I', 'J', 'K', 'L', 'O', // Kode barang, Nama barang, Qty. , Harga satuan, Harga total
            'Q', 'R', 'S', 'T', 'W',
            'Y', 'Z', 'AA', 'AB', 'AE'
        ];

        $range = 'A2:FG17';
        $salesData = $this->googleSheets->getSelectedColumnsGrouped($sheet.$range, $columns);
        // return response()->json($salesData);

        $salesCharts = [];
        for ($i = 0; $i < 25; $i++) {
            $temp = SalesDailyChart::build();
            $temp
            ->setSubtitle('Awikwok'.$i)
            ->setStacked(true)
            ->addData('Money', $salesData[5])
            ->addData('Money 2', $salesData[10])
            ->setXAxis($salesData[0]);
            array_push($salesCharts, $temp);
        }

        $currPage = Paginator::resolveCurrentPage();
        $currentPageItems = array_slice($salesCharts, ($currPage - 1) * 1, 1);

        $paginatedCharts = new LengthAwarePaginator($currentPageItems, 25, 1, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        // We have to format the data somehow so that it could be processed like this :
        // $chart = (new BarChart)
        //     ->setTitle('Sales Data by Product Type')
        //     ->setSubtitle('Each color represents a different product')
        //     ->addData('Product A', [10, 0, 10, 0])
        //     ->addData('Product B', [20, 0, 5, 10])
        //     ->addData('Product C', [0, 30, 15, 5])
        //     ->setXAxis(['p1', 'p2', 'p3', 'p4'])
        //     ->setColors(['#FF5733', '#33FF57', '#3357FF'])
        //     ->setStacked(true);

        return view('pages.dashboard', ['charts' => $paginatedCharts, 'currentPage' => 'dashboard']);
    }
}
