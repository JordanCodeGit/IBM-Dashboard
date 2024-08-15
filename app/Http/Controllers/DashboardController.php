<?php

namespace App\Http\Controllers;

use App\Jobs\SpreadsheetJob;
use App\Models\Settings;
use marineusde\LarapexCharts\Charts\BarChart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $runSetup = Settings::where('key', 'RUN_SETUP')->first();

        if (!$runSetup) {
            $job = new SpreadsheetJob(true);
            dispatch($job);
            Settings::create([
                'key' => 'RUN_SETUP',
                'value' => 'true'
            ]);
        }
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
