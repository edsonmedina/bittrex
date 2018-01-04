<?php

namespace edsonmedina\bittrex\publicinfo;

use edsonmedina\bittrex\common\Money;

class Ticker
{
    /** @var float */
    private $bid;

    /** @var float */
    private $ask;

    /** @var float */
    private $last;

    /** @var string */
    private $fromCurrency;

    public function __construct(string $fromCurrency, float $bid, float $ask, float $last)
    {
        $this->fromCurrency = $fromCurrency;
        $this->bid = $bid;
        $this->ask = $ask;
        $this->last = $last;
    }

    /**
     * @return Money
     */
    public function getBid(): Money
    {
        return new Money($this->bid, $this->fromCurrency);
    }

    /**
     * @return Money
     */
    public function getAsk(): Money
    {
        return new Money($this->ask, $this->fromCurrency);
    }

    /**
     * @return Money
     */
    public function getLast(): Money
    {
        return new Money($this->last, $this->fromCurrency);
    }
}