<?php

namespace edsonmedina\bittrex\account;

use edsonmedina\bittrex\common\Money;

class Order
{
    /** @var string */
    private $uuid;

    /** @var string */
    private $fromCurrency;

    /** @var string */
    private $toCurrency;

    /** @var string */
    private $timestamp;

    /** @var string */
    private $orderType;

    /** @var float */
    private $limit;

    /** @var float */
    private $quantity;

    /** @var float */
    private $quantityRemanining;

    /** @var float */
    private $commission;

    /** @var float */
    private $price;

    /** @var float */
    private $pricePerUnit;

    /** @var bool */
    private $isConditional;

    /** @var string */
    private $condition;

    /** @var string */
    private $conditionTarget;

    /** @var bool */
    private $immediateOrCancel;

    public function __construct(
        string $uuid, string $market, string $timestamp, string $orderType,
        float $limit, float $quantity, float $quantityRemanining,
        float $commission, float $price, float $pricePerUnit,
        bool $isConditional, string $condition, string $conditionTarget,
        bool $immediateOrCancel
    )
    {
        list ($fromCurrency, $toCurrency) = explode('-', $market);

        $this->uuid = $uuid;
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
        $this->timestamp = $timestamp;
        $this->orderType = $orderType;
        $this->limit = $limit;
        $this->quantity = $quantity;
        $this->quantityRemanining = $quantityRemanining;
        $this->commission = $commission;
        $this->price = $price;
        $this->pricePerUnit = $pricePerUnit;
        $this->isConditional = $isConditional;
        $this->condition = $condition;
        $this->conditionTarget = $conditionTarget;
        $this->immediateOrCancel = $immediateOrCancel;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return Market
     */
    public function getMarket(): Market
    {
        return new Market($this->fromCurrency, $this->toCurrency);
    }

    /**
     * @return string
     */
    public function getTimestamp(): string
    {
        // TODO return \DateTime
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getOrderType(): string
    {
        return $this->orderType;
    }

    /**
     * @return Money
     */
    public function getLimit(): Money
    {
        return new Money($this->limit, $this->fromCurrency);
    }

    /**
     * @return Money
     */
    public function getQuantity(): Money
    {
        return new Money($this->quantity, $this->toCurrency);
    }

    /**
     * @return Money
     */
    public function getQuantityRemanining(): Money
    {
        return new Money($this->quantityRemanining, $this->toCurrency);
    }

    /**
     * @return Money
     */
    public function getCommission(): Money
    {
        return new Money($this->commission, $this->fromCurrency);
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return new Money($this->price, $this->fromCurrency);
    }

    /**
     * @return Money
     */
    public function getPricePerUnit(): Money
    {
        return new Money($this->pricePerUnit, $this->fromCurrency);
    }

    /**
     * @return bool
     */
    public function isConditional(): bool
    {
        return $this->isConditional;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return string
     */
    public function getConditionTarget(): string
    {
        return $this->conditionTarget;
    }

    /**
     * @return bool
     */
    public function isImmediateOrCancel(): bool
    {
        return $this->immediateOrCancel;
    }
}