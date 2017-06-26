<?php

namespace edsonmedina\bittrex\publicinfo;

class Market
{
    /** @var string */
    private $marketCurrency;

    /** @var string */
    private $baseCurrency;

    /** @var string */
    private $marketCurrencyName;

    /** @var string */
    private $baseCurrencyName;

    /** @var float */
    private $minTradeSize;

    /** @var string */
    private $marketName;

    /** @var bool */
    private $isActive;

    /** @var string */
    private $createDate;

    public function __construct(
        string $marketCurrency, string $baseCurrency, string $marketCurrencyName,
        string $baseCurrencyName, float $minTradeSize, string $marketName,
        bool $isActive, string $createDate
    )
    {
        $this->marketCurrency = $marketCurrency;
        $this->baseCurrency = $baseCurrency;
        $this->marketCurrencyName = $marketCurrencyName;
        $this->baseCurrencyName = $baseCurrencyName;
        $this->minTradeSize = $minTradeSize;
        $this->marketName = $marketName;
        $this->isActive = $isActive;
        $this->createDate = $createDate;
    }

    /**
     * @return Currency
     */
    public function getMarketCurrency(): Currency
    {
        return new Currency($this->marketCurrency, $this->marketCurrencyName);
    }

    /**
     * @return Currency
     */
    public function getBaseCurrency(): Currency
    {
        return new Currency($this->baseCurrency, $this->baseCurrencyName);
    }

    /**
     * @return float
     */
    public function getMinTradeSize(): float
    {
        return $this->minTradeSize;
    }

    /**
     * @return string
     */
    public function getMarketName(): string
    {
        return $this->marketName;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @return string
     */
    public function getCreateDate(): string
    {
        // TODO return \DateTime
        return $this->createDate;
    }
}