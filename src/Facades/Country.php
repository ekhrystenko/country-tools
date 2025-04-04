<?php

namespace Eugene\CountryTools\Facades;

use Illuminate\Support\Facades\Facade;

class Country extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'country';
    }
}