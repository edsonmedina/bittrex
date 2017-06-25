<?php

namespace edsonmedina\bittrex\valueobjects;

class Address
{
    /** @var string */
    private $currency;

    /** @var string */
    private $address;

    public function __construct(string $currency, string $address)
    {
        $this->currency = $currency;
        $this->address = $address;
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
    public function getAddress(): string
    {
        return $this->address;
    }
}