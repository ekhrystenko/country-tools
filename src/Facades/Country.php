<?php

namespace Eugene\CountryTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Country
 *
 * @method static \Eugene\CountryTools\Services\CountryService getFacadeRoot()
 * @method static \Illuminate\Support\Collection getCountryCodes()
 * @method static \Illuminate\Support\Collection getAllCountries()
 * @method static \Eugene\CountryTools\ValueObjects\Country getCountry(string $code)
 * @method static string|null getName(string $code)
 * @method static string|null getFlag(string $code)
 * @method static string|null getPhoneCode(string $code)
 * @method static string|null getCurrency(string $code)
 *
 * @package Eugene\CountryTools\Facades
 */
class Country extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'country';
    }
}