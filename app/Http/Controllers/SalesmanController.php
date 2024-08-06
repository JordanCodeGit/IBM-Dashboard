<?php

namespace App\Http\Controllers;

use App\Charts\SalesDailyChart;
use App\Services\GoogleSheetsService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class SalesmanController extends Controller
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
            'path' => url('/salesman'),
            'query' => $request->query(),
        ]);

        return view('pages.salesman', ['charts' => $paginatedCharts, 'currentPage' => 'salesman']);
    }
}
