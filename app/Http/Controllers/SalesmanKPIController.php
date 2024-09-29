<?php

namespace App\Http\Controllers;

use App\Models\KeyPerformanceIndex;
use App\Models\Salesman;
use App\Models\SalesmanPerformance;
use Illuminate\Http\Request;

class SalesmanKPIController extends Controller
{
    public function index() {
        $salesmen = Salesman::where('nama', 'not like', '%SPV%')->orderBy('nama', 'ASC')->get();

        return view('pages.kpi-form', ['currentPage' => 'salesman-kpi', 'salesmen' => $salesmen]);
    }

    private function kpi_save(Request $request, $input_name, $max_point, $enum) {
        // $kpi = new KeyPerformanceIndex();
        // $kpi->target = $request[$input_name.'-target'];
        // $kpi->pencapaian = $request[$input_name.'-pencapaian'];
        // $kpi->persentase = $kpi->target/$kpi->pencapaian;

        // if ()

        $kpi = KeyPerformanceIndex::create([
            'target' => $request[$input_name.'-target'],
            'pencapaian' => $request[$input_name.'-pencapaian'],
            'persentase' => $request[$input_name.'-pencapaian']/$request[$input_name.'-target'],
            // 'poin' => $request[$input_name.'-pencapaian']/$request[$input_name.'-target'] * $max_point,
            'poin' => $request[$input_name.'-poin'],
            'tipe_indeks' => $enum
        ]);

        return [$kpi->id, $kpi->poin];
    }

    public function save(Request $request) {
        $kpi_save_template = [
            'absen' => [5, 'absensi'],
            'reg' => [30, 'sales_reguler'],
            'kat' => [20, 'sales_kategori'],
            'toko' => [15, 'toko'],
            'tagih' => [30, 'penagihan']
        ];
        $kpi_ids = [];
        $total_poin = 0;

        foreach ($kpi_save_template as $key => $value) {
            $temp = $this->kpi_save($request, $key, $value[0], $value[1]);
            $total_poin += $temp[1];
            array_push($kpi_ids, $temp[0]);
        }

        SalesmanPerformance::create([
            'id_salesman' => $request['salesman'],
            'periode' => $request['periode'],
            'id_kpi_absensi' => $kpi_ids[0],
            'id_kpi_sales_reguler' => $kpi_ids[1],
            'id_kpi_sales_kategori' => $kpi_ids[2],
            'id_kpi_toko' => $kpi_ids[3],
            'id_kpi_penagihan' => $kpi_ids[4],
            'total_poin' => $total_poin
        ]);

        return back()->with(['message' => 'KPI added successfully.']);
    }
}
