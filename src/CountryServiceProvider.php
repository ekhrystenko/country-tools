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
        $this->registerBindings();
        $this->registerSingletons();
        $this->registerAliases();
        $this->registerCommands();
        $this->registerConfig();
    }

    private function registerBindings(): void
    {
        $this->app->bind(CountryRepositoryInterface::class, FileCountryRepository::class);
    }

    private function registerSingletons(): void
    {
        $this->app->singleton(CountryService::class, function ($app) {
            return new CountryService($app->make(CountryRepositoryInterface::class));
        });
    }

    private function registerAliases(): void
    {
        $this->app->alias(CountryService::class, 'country');
    }

    private function registerCommands(): void
    {
        $this->commands([
            GenerateCountryJson::class,
        ]);
    }

    protected function registerCommandSchedules(): void
    {
        //
    }

    protected function registerObservers(): void
    {
        //
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/country-tools.php',
            'country-tools'
        );
    }

    public function boot()
    {

    }
}
