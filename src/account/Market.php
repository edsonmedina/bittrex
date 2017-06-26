<?php

namespace edsonmedina\bittrex\account;

class Market
{
    /** @var string */
    private $fromCurrency;

    /** @var string */
    private $toCurrency;

    public function __construct(string $fromCurrency, string $toCurrency)
    {
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
    }

    /**
     * @return string
     */
    public function getFromCurrency(): string
    {
        return $this->fromCurrency;
    }

    /**
     * @return string
     */
    public function getToCurrency(): string
    {
        return $this->toCurrency;
    }

    /**
     * @return string
     */
    public function getExchange(): string
    {
        return $this->fromCurrency.'-'.$this->toCurrency;
    }
}