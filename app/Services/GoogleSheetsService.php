<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Sheets as GoogleServiceSheets;
use GuzzleHttp\Client as GuzzleClient;

class GoogleSheetsService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        // Create a custom Guzzle client with SSL verification disabled
        $guzzleClient = new GuzzleClient([
            'verify' => false, // Disable SSL certificate verification
        ]);

        // Initialize the Google Client with the custom Guzzle client
        $this->client = new GoogleClient();
        $this->client->setHttpClient($guzzleClient); // Set the custom Guzzle client
        $this->client->setAuthConfig(config('google-sheets.credentials_path'));
        $this->client->addScope(GoogleServiceSheets::SPREADSHEETS);

        // Initialize the Google Sheets service
        $this->service = new GoogleServiceSheets($this->client);
    }

    public function getSpreadsheetValues($range)
    {
        $spreadsheetId = config('google-sheets.spreadsheet_id');
        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range)->getValues();
        return $response;
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
