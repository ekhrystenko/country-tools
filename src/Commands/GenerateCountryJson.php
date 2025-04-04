<?php

namespace Eugene\CountryTools\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class GenerateCountryJson extends Command
{
    protected $signature = 'country:generate-json';
    protected $description = 'Download country data and generate countries.json';

    public function handle()
    {
        $this->info('Fetching countries from API...');

        $response = Http::get('https://restcountries.com/v3.1/all');

        if (!$response->ok()) {
            $this->error('Failed to fetch countries.');
            return;
        }

        $data = $response->json();
        $countries = [];

        foreach ($data as $item) {
            $code = strtoupper($item['cca2'] ?? null);

            if (!$code) continue;

            $countries[$code] = [
                'name' => $item['translations']['uk']['common'] ?? $item['name']['common'] ?? '',
                'flag' => $item['flag'] ?? '',
                'phone_code' => isset($item['idd']['root']) ? $item['idd']['root'] . ($item['idd']['suffixes'][0] ?? '') : '',
                'currency' => array_keys($item['currencies'] ?? [])[0] ?? '',
            ];
        }

        $jsonPath = base_path('storage/countries.json');

        if (!File::exists(dirname($jsonPath))) {
            File::makeDirectory(dirname($jsonPath), 0775, true);
        }

        file_put_contents($jsonPath, json_encode($countries, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info('countries.json generated successfully!');
    }
}