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

class SettingsController extends Controller
{
    public function index() {
        $dashboard_url = Settings::where('key', 'DASHBOARD_URL')->first();

        return view('pages.settings', ['currentPage' => 'settings', 'dashboard' => $dashboard_url]);
    }

    public function updateDashboardURL(Request $request) {
        $request->validate(['url' => 'url']);
        Settings::updateOrCreate(['key' => 'DASHBOARD_URL'], ['value' => $request->input('url')]);

        return back()->with(['message' => 'Dashboard link updated successfully!']);
    }

    public function resetDashboardURL() {
        Settings::where('key', 'DASHBOARD_URL')->delete();

        return back()->with(['message' => 'Dashboard link reset successfully!']);
    }

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

        return redirect('/settings')->with(['message' => 'Data fetched successfully!']);
    }

    public function deleteAll() {
        Transaksi_Barang::query()->delete();
        Transaksi::query()->delete();
        Barang::query()->delete();
        Salesman::query()->delete();
        Settings::query()->delete();

        return redirect('/settings')->with(['message' => 'All data deleted successfully!']);
    }

    public function resetSchema() {
        Artisan::call('migrate:fresh');

        return redirect('/settings')->with(['message' => 'Database schema reset success.']);
    }
}
