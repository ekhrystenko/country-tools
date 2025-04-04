<?php

namespace Eugene\CountryTools\ValueObjects;

class Country
{
    public string $code;
    public string $name;
    public string $flag;
    public string $phoneCode;
    public string $currency;

    public function __construct(string $code, string $name, string $flag, string $phoneCode, string $currency)
    {
        $this->code = $code;
        $this->name = $name;
        $this->flag = $flag;
        $this->phoneCode = $phoneCode;
        $this->currency = $currency;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

    public function getPhoneCode(): string
    {
        return $this->phoneCode;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}