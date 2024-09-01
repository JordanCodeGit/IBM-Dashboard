<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use marineusde\LarapexCharts\Charts\BarChart;
use marineusde\LarapexCharts\Options\XAxisOption;

class SalesmanController extends Controller
{
    public function index(Request $request) {
        return view('pages.salesman', ['currentPage' => 'salesman']);
    }
}
