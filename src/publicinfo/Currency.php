<?php

namespace edsonmedina\bittrex\publicinfo;

class Currency
{
    /** @var string */
    private $currency;

    /** @var string */
    private $currencyName;

    public function __construct(string $currency, string $currencyName)
    {
        $this->currency = $currency;
        $this->currencyName = $currencyName;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getCurrencyName(): string
    {
        return $this->currencyName;
    }
}