<?php

namespace Eugene\CountryTools\tests;

use Eugene\CountryTools\Services\CountryService;
use Eugene\CountryTools\Interfaces\CountryRepositoryInterface;
use Eugene\CountryTools\ValueObjects\Country;
use PHPUnit\Framework\TestCase;
use Mockery;

// Run command ./vendor/bin/phpunit tests/CountryServiceTest.php
class CountryServiceTest extends TestCase
{
    protected CountryService $countryService;
    protected Object $countryRepositoryMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->countryRepositoryMock = Mockery::mock(CountryRepositoryInterface::class);

        $countriesData = [
            'UA' => [
                'name' => 'Ukraine',
                'flag' => '🇺🇦',
                'phone_code' => '+380',
                'currency' => 'UAH'
            ],
            'AE' => [
                'name' => 'United Arab Emirates',
                'flag' => '🇦🇪',
                'phone_code' => '+971',
                'currency' => 'AED'
            ],
        ];

        $this->countryRepositoryMock->shouldReceive('getAllCountries')
            ->andReturn($countriesData);

        $this->countryService = new CountryService($this->countryRepositoryMock);
    }

    /**
     * @return void
     */
    public function testGetCountry(): void
    {
        $country = $this->countryService->getCountry('UA');
        $this->assertInstanceOf(Country::class, $country);
        $this->assertEquals('Ukraine', $country->getName());
        $this->assertEquals('🇺🇦', $country->getFlag());
        $this->assertEquals('+380', $country->getPhoneCode());
        $this->assertEquals('UAH', $country->getCurrency());
    }

    public function tearDown(): void
    {
        Mockery::close();
    }
}