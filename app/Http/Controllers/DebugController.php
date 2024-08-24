<?php

namespace App\Http\Controllers;

use App\Jobs\SpreadsheetJob;
use App\Models\Barang;
use App\Models\Salesman;
use App\Models\Settings;
use App\Models\Transaksi;
use App\Models\Transaksi_Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DebugController extends Controller
{
    public function fetchAll() {
        $runSetup = Settings::where('key', 'RUN_SETUP')->first();
        if (!$runSetup) {
            $job = new SpreadsheetJob(true);
            dispatch($job);
            Settings::create([
                'key' => 'RUN_SETUP',
                'value' => 'true'
            ]);
        }

        return redirect('/')->with('type', 'fetch');
    }

    public function deleteAll() {
        Transaksi_Barang::query()->delete();
        Transaksi::query()->delete();
        Barang::query()->delete();
        Salesman::query()->delete();
        Settings::query()->delete();

        return redirect('/')->with(['type' => 'delete']);
    }

    public function resetSchema() {
        Artisan::call('migrate:fresh');

        return redirect('/')->with(['type' => 'reset']);
    }
}
