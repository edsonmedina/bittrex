<?php

namespace edsonmedina\bittrex\valueobjects;

class Payment
{
    /** @var int */
    private $id;

    /** @var float */
    private $amount;

    /** @var string */
    private $currency;

    /** @var int */
    private $confirmations;

    /** @var string */
    private $lastUpdated;

    /** @var string */
    private $txId;

    /** @var string */
    private $address;

    public function __construct(
        int $id, float $amount, string $currency, int $confirmations,
        string $lastUpdated, string $txId, string $address
    )
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->confirmations = $confirmations;
        $this->lastUpdated = $lastUpdated;
        $this->txId = $txId;
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return new Money($this->amount, $this->currency);
    }

    /**
     * @return int
     */
    public function getConfirmations(): int
    {
        return $this->confirmations;
    }

    /**
     * @return string
     */
    public function getLastUpdated(): string
    {
        // TODO return \DateTime
        return $this->lastUpdated;
    }

    /**
     * @return string
     */
    public function getTxId(): string
    {
        return $this->txId;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return new Address($this->currency, $this->address);
    }
}