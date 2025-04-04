<?php

namespace Eugene\CountryTools;

use Eugene\CountryTools\Commands\GenerateCountryJson;
use Eugene\CountryTools\Interfaces\CountryRepositoryInterface;
use Eugene\CountryTools\Repositories\FileCountryRepository;
use Eugene\CountryTools\Services\CountryService;
use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * Service Provider Register
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CountryRepositoryInterface::class, FileCountryRepository::class);

        $this->app->singleton(CountryService::class, function ($app) {
            return new CountryService($app->make(CountryRepositoryInterface::class));
        });

        $this->app->alias(CountryService::class, 'country');

        $this->commands([
            GenerateCountryJson::class,
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/Config/country-tools.php',
            'country-tools'
        );
    }

    /**
     * Service Provider Boot
     *
     * @return void
     */
    public function boot()
    {

    }
}
