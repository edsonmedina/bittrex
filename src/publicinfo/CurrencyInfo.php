<?php

namespace edsonmedina\bittrex\publicinfo;

class CurrencyInfo
{
    /** @var string */
    private $currency;

    /** @var string */
    private $currencyName;

    /** @var int */
    private $minConfirmations;

    /** @var float */
    private $transferFee;

    /** @var bool */
    private $isActive;

    /** @var string */
    private $coinType;

    /** @var null|string */
    private $baseAddress;

    public function __construct(
        string $currency, string $currencyName, int $minConfirmations,
        float $transferFee, bool $isActive, string $coinType,
        ?string $baseAddress = null
    )
    {
        $this->currency = $currency;
        $this->currencyName = $currencyName;
        $this->minConfirmations = $minConfirmations;
        $this->transferFee = $transferFee;
        $this->isActive = $isActive;
        $this->coinType = $coinType;
        $this->baseAddress = $baseAddress;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return new Currency($this->currency, $this->currencyName);
    }

    /**
     * @return int
     */
    public function getMinConfirmations(): int
    {
        return $this->minConfirmations;
    }

    /**
     * @return float
     */
    public function getTransferFee(): float
    {
        return $this->transferFee;
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
    public function getCoinType(): string
    {
        return $this->coinType;
    }

    /**
     * @return null|string
     */
    public function getBaseAddress()
    {
        return $this->baseAddress;
    }
}