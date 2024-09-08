<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use marineusde\LarapexCharts\Charts\BarChart;
use Illuminate\Http\Request;
use marineusde\LarapexCharts\Options\XAxisOption;

class DashboardController extends Controller
{
    public function index(Request $request) {
        /*=========================================

        This part is used for debugging. Getting
        data,

        =========================================*/


        // We have to format the data somehow so that it could be processed like this :
        // $chart = (new BarChart)
        //     ->setTitle('Sales Data by Product Type')
        //     ->setSubtitle('Each color represents a different product')
        //     ->addData('Product A', [10, 0, 10, 0])
        //     ->addData('Product B', [20, 0, 5, 10])
        //     ->addData('Product C', [0, 30, 15, 5])
        //     ->setXAxisOption(new XAxisOption(['p1', 'p2', 'p3', 'p4']))
        //     ->setColors(['#FF5733', '#33FF57', '#3357FF'])
        //     ->setStacked(true);

        $dashboard_url = Settings::where('key', 'DASHBOARD_URL')->first();

        return view('pages.dashboard', ['currentPage' => 'dashboard', 'dashboard' => $dashboard_url ? $dashboard_url->value : null]);
    }
}
