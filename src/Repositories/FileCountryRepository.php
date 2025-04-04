<?php

namespace Eugene\CountryTools\Repositories;

use Eugene\CountryTools\Interfaces\CountryRepositoryInterface;
use Illuminate\Support\Facades\File;

class FileCountryRepository implements CountryRepositoryInterface
{
    protected string $filePath;

    public function __construct(string $filePath = null)
    {
        $this->filePath = $filePath ?? config('country-tools.json_path');
    }

    public function getAllCountries(): array
    {
        if (File::exists($this->filePath)) {
            $json = File::get($this->filePath);
            return json_decode($json, true);
        }
        return [];
    }
}