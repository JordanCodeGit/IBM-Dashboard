<?php

namespace App\Http\Controllers;

use App\Services\GoogleSheetsService;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    protected $googleSheets;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheets = $googleSheetsService;
    }

    public function index() {
        $range = 'INPUT SALESMAN!A1:C10';
        $values = $this->googleSheets->getSpreadsheetValues($range);
        return view('pages.driver', ['spreadSheetData' => serialize($values), 'currentPage' => 'driver']);
    }
}
