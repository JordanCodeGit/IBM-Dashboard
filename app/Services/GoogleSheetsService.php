<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Sheets as GoogleServiceSheets;

class GoogleSheetsService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new GoogleClient();
        $this->client->setAuthConfig(config('google-sheets.credentials_path'));
        $this->client->addScope(GoogleServiceSheets::SPREADSHEETS);
        $this->service = new GoogleServiceSheets($this->client);
    }

    public function getSpreadsheetValues($range)
    {
        $spreadsheetId = config('google-sheets.spreadsheet_id');
        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
        return $response->getValues();
    }

    public function getSelectedColumns($range, $columns)
    {
        $values = $this->getSpreadsheetValues($range);
        $selectedColumns = [];

        foreach ($values as $row) {
            $filteredRow = [];
            foreach ($columns as $column) {
                $columnIndex = $this->columnLetterToIndex($column);
                $filteredRow[] = $row[$columnIndex] ?? null;
            }
            $selectedColumns[] = $filteredRow;
        }

        return $selectedColumns;
    }

    public function getSelectedColumnsGrouped($range, $columns)
    {
        $values = $this->getSpreadsheetValues($range);
        $selectedColumns = array_fill(0, count($columns), []);

        foreach ($values as $row) {
            foreach ($columns as $index => $column) {
                $columnIndex = $this->columnLetterToIndex($column);
                $selectedColumns[$index][] = $row[$columnIndex] ?? null;
            }
        }

        return $selectedColumns;
    }

    private function columnLetterToIndex($letter)
    {
        $letter = strtoupper($letter);
        $length = strlen($letter);
        $index = 0;

        for ($i = 0; $i < $length; $i++) {
            $index *= 26;
            $index += ord($letter[$i]) - ord('A') + 1;
        }

        return $index - 1;
    }
}
