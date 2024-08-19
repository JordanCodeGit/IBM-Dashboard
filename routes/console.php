<?php

use App\Jobs\SalesmanJob;
use App\Models\Settings;
use App\Services\GoogleSheetsService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Get latest or values in specified range
function getSpreadsheetData($range) {
    $googleSheets = new GoogleSheetsService;

    return $googleSheets->getSpreadsheetValues('INPUT SALESMAN!A'.$range.':FL');
}

// Execute function every 30s
Schedule::call(function () {
    // Get status on last row based on latest update
    $lastRowCount = (int) Settings::where('key', 'last_row')->value('value');
    // Get live data
    $spreadsheetData = getSpreadsheetData(2);

    // If the last row is lower than the live data count
    if ($lastRowCount < count($spreadsheetData) + 1) {
        // Save the newest row value
        Settings::where('key', 'last_row')->update(['value', (string)end($spreadsheetData)]);
        // Get new spreadsheet data
        $spreadsheetData = $this->getSpreadsheetData((string)$lastRowCount + 1);
        // Dispatch job
        $job = new SalesmanJob($spreadsheetData);
        dispatch($job);
    }
})->everyThirtySeconds();
