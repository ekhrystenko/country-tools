<?php

namespace Eugene\CountryTools\Services;

use Eugene\CountryTools\Enums\CountryKeys;
use Eugene\CountryTools\Interfaces\CountryRepositoryInterface;
use Eugene\CountryTools\ValueObjects\Country;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CountryService
{
    private const CACHE_TIME = 3600;
    private const CACHE_KEY = 'country_codes';
    private const CACHE_ALL_KEY = 'all_countries';
    protected Collection $countries;

    public function __construct(CountryRepositoryInterface $repository)
    {
        $this->countries = collect($repository->getAllCountries());
    }

    public function getCountryCodes(): Collection
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TIME, function () {
            return $this->countries->keys();
        });
    }

    public function getAllCountries(): Collection
    {
        return Cache::remember(self::CACHE_ALL_KEY, self::CACHE_TIME, function () {
            return $this->countries->map(function ($data, $code) {
                return $this->mapToCountry($code, $data);
            })->values();
        });
    }

    public function getCountry(string $code): ?Country
    {
        $data = $this->countries->get(strtoupper($code));
        return $data ? $this->mapToCountry($code, $data) : null;
    }

    public function getName(string $code): ?string
    {
        return $this->getCountryData($code, CountryKeys::NAME);
    }

    public function getFlag(string $code): ?string
    {
        return $this->getCountryData($code, CountryKeys::FLAG);
    }

    public function getPhoneCode(string $code): ?string
    {
        return $this->getCountryData($code, CountryKeys::PHONE_CODE);
    }

    public function getCurrency(string $code): ?string
    {
        return $this->getCountryData($code, CountryKeys::CURRENCY);
    }

    private function getCountryData(string $code, CountryKeys $key): ?string
    {
        $country = $this->countries->get(strtoupper($code));
        return $country[$key->value] ?? null;
    }

    private function getCountryByCode(string $code): ?array
    {
        return $this->countries->get(strtoupper($code));
    }

    private function mapToCountry(string $code, array $data): Country
    {
        return new Country(
            strtoupper($code),
            $data['name'],
            $data['flag'],
            $data['phone_code'],
            $data['currency']
        );
    }
}