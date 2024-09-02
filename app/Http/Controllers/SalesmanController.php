<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    public function index(Request $request) {
        $startDate = Carbon::now()->subMonth()->startOfMonth()->addDays(25); // 26th of last month
        $endDate = Carbon::now()->startOfMonth()->addDays(24); // 25th of this month

        $generalData = Transaksi::orderBy('tanggal', 'asc')->with('salesman')->with('transaksi_barang.barang')->paginate(25, ['*'], 'general_page');
        $dailyData = Transaksi::where('tanggal', Carbon::today('Asia/Jakarta'))->orderBy('tanggal', 'asc')->with('salesman')->with('transaksi_barang.barang')->paginate(25, ['*'], 'daily_page');
        $monthlyData = Transaksi::whereBetween('tanggal', [$startDate, $endDate])->orderBy('tanggal', 'asc')->with('salesman')->with('transaksi_barang.barang')->paginate(25, ['*'], 'monthly_page');
        return view('pages.salesman', [
            'currentPage' => 'salesman',
            'general' => $generalData,
            'daily' => $dailyData,
            'monthly' => $monthlyData
        ]);
    }
}
