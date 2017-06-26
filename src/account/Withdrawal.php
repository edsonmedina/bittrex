<?php

namespace edsonmedina\bittrex\account;

class Withdrawal
{
    /** @var string */
    private $uuid;

    /** @var string */
    private $currency;

    /** @var float */
    private $amount;

    /** @var string */
    private $address;

    /** @var string */
    private $opened;

    /** @var bool */
    private $authorized;

    /** @var bool */
    private $pendingPayment;

    /** @var float */
    private $txCost;

    /** @var string */
    private $txId;

    /** @var bool */
    private $canceled;

    /** @var bool */
    private $invalidAddress;

    public function __construct(
        string $uuid, string $currency, float $amount, string $address, string $opened,
        bool $authorized, bool $pendingPayment, float $txCost, string $txId,
        bool $canceled, bool $invalidAddress
    )
    {
        $this->uuid = $uuid;
        $this->currency = $currency;
        $this->amount = $amount;
        $this->address = $address;
        $this->opened = $opened;
        $this->authorized = $authorized;
        $this->pendingPayment = $pendingPayment;
        $this->txCost = $txCost;
        $this->txId = $txId;
        $this->canceled = $canceled;
        $this->invalidAddress = $invalidAddress;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return new Money($this->amount, $this->currency);
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return new Address($this->currency, $this->address);
    }

    /**
     * @return string
     */
    public function getOpened(): string
    {
        // TODO return \DateTime
        return $this->opened;
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->authorized;
    }

    /**
     * @return bool
     */
    public function isPendingPayment(): bool
    {
        return $this->pendingPayment;
    }

    /**
     * @return float
     */
    public function getTxCost(): float
    {
        return $this->txCost;
    }

    /**
     * @return string
     */
    public function getTxId(): string
    {
        return $this->txId;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->canceled;
    }

    /**
     * @return bool
     */
    public function isInvalidAddress(): bool
    {
        return $this->invalidAddress;
    }
}