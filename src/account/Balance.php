<?php

namespace edsonmedina\bittrex\account;

use edsonmedina\bittrex\common\Money;

class Balance
{
    /** @var string */
    private $currency;

    /** @var int */
    private $balance;

    /** @var int */
    private $available;

    /** @var int */
    private $pending;

    /** @var string */
    private $address;

    /** @var bool */
    private $requested;

    /** @var string */
    private $uuid;

    public function __construct(string $currency, float $balance, float $available, float $pending, string $address, ?bool $requested = null, ?string $uuid = null)
    {
        $this->currency  = $currency;
        $this->balance   = $balance;
        $this->available = $available;
        $this->pending   = $pending;
        $this->address   = $address;
        $this->requested = $requested;
        $this->uuid      = $uuid;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return new Money($this->balance, $this->currency);
    }

    /**
     * @return Money
     */
    public function getAvailable(): Money
    {
        return new Money($this->available, $this->currency);
    }

    /**
     * @return Money
     */
    public function getPending(): Money
    {
        return new Money($this->pending, $this->currency);
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return new Address($this->currency, $this->address);
    }

    /**
     * @return bool
     */
    public function isRequested(): bool
    {
        return $this->requested;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}