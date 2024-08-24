<?php

namespace App\Http\Controllers;

use App\Models\Salesman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class APISalesmanController extends Controller
{
    public function get() {
        $data = Salesman::with('transaksi.transaksi_barang.barang');
        if ($data->exists()) {
            return response()->json($data->get());
        }
        return response()->json(['message' => 'Database is empty.']);
    }

    public function getDaily() {
        $data = Salesman::with([
            'transaksi' => function ($query) {
                $query->where('tanggal', Carbon::today('Asia/Jakarta'))->with('transaksi_barang.barang');
            },
        ]);
        if ($data->exists()) {
            return response()->json($data->get());
        }
        return response()->json(['message' => 'Database is empty.']);
    }

    public function getMonthly() {
        $startDate = Carbon::now()->subMonth()->startOfMonth()->addDays(25); // 26th of last month
        $endDate = Carbon::now()->startOfMonth()->addDays(24); // 25th of this month
        $data = Salesman::with([
            'transaksi' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate])->with('transaksi_barang.barang');
            },
        ]);
        if ($data->exists()) {
            return response()->json($data->get());
        }
        return response()->json(['message' => 'Database is empty.']);
    }

    public function getBySalesmanId($id) {
        $data = Salesman::where('id_salesman', $id);
        if ($data->exists()) {
            $data = $data->with('transaksi.transaksi_barang.barang');
            return response()->json($data->get());
        }
        return response()->json(['message' => 'Salesman not found.']);
    }

    public function getBySalesmanIdDaily($id) {
        $data = Salesman::where('id_salesman', $id);
        if ($data->exists()) {
            $data = $data->with([
                'transaksi' => function ($query) {
                    $query->where('tanggal', Carbon::today('Asia/Jakarta'))->with('transaksi_barang.barang');
                },
            ]);
            return response()->json($data->get());
        }
        return response()->json(['message' => 'Salesman not found.']);
    }

    public function getBySalesmanIdMonthly($id) {
        $startDate = Carbon::now()->subMonth()->startOfMonth()->addDays(25); // 26th of last month
        $endDate = Carbon::now()->startOfMonth()->addDays(24); // 25th of this month
        $data = Salesman::where('id_salesman', $id);
        if ($data->exists()) {
            $data = $data->with([
                'transaksi' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('tanggal', [$startDate, $endDate])->with('transaksi_barang.barang');
                },
            ]);
            return response()->json($data->get());
        }
        return response()->json(['message' => 'Salesman not found.']);
    }
}
