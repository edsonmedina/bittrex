<?php
namespace edsonmedina\bittrex;

use edsonmedina\bittrex\valueobjects\Address;
use edsonmedina\bittrex\valueobjects\Balance;
use edsonmedina\bittrex\valueobjects\Market;
use edsonmedina\bittrex\valueobjects\Money;
use edsonmedina\bittrex\valueobjects\Order;
use edsonmedina\bittrex\valueobjects\Payment;
use edsonmedina\bittrex\valueobjects\Withdrawal;

require __DIR__.'/../vendor/autoload.php';

class Account
{
    /** @var string */
    private $apiKey;

    /** @var \GuzzleHttp\Client */
    private $guzzle;

    /** @var string */
    private $secret;

    const baseUrl = 'https://bittrex.com/api/v1.1/';

    static public function connect (string $apiKey, string $secret): Account
    {
        $guzzle = new \GuzzleHttp\Client([
            'base_uri' => self::baseUrl,
            'timeout' => 5
        ]);

        return new self($apiKey, $secret, $guzzle);
    }

    public function __construct(string $apiKey, string $secret, \GuzzleHttp\Client $guzzle)
    {
        $this->apiKey = $apiKey;
        $this->guzzle = $guzzle;
        $this->secret = $secret;
    }

    /**
     * @param string $method
     * @param array $extraParams
     * @return mixed
     * @throws \RuntimeException
     */
    protected function call(string $method, array $extraParams = [])
    {
        $uri = self::baseUrl . $method . '?apikey=' . $this->apiKey . '&nonce=' . time();

        if (!empty($extraParams)) {
            $uri .= '&'.http_build_query($extraParams);
        }

        $signature = hash_hmac('sha512', $uri, $this->secret);

        $options = [
            'headers' => [
                'User-Agent' => 'Bittrex client (github.com/edsonmedina/bittrex)',
                'apisign' => $signature
            ]
        ];

        $httpResponse = $this->guzzle->request('GET', $uri, $options);
        $jsonString = $httpResponse->getBody()->getContents();

        $response = \GuzzleHttp\json_decode(
            $jsonString
        );

        if ($response->success !== true) {
            throw new \RuntimeException($response->message);
        }

        return $response->result;
    }

    /**
     * @return Balance[]
     * @throws \RuntimeException
     */
    public function getBalances(): array
    {
        $response = $this->call('account/getbalances');

        return array_map (
            function ($balance) {
                return new Balance(
                    (string) $balance->Currency,
                    (float)  $balance->Balance,
                    (float)  $balance->Available,
                    (float)  $balance->Pending,
                    (string) $balance->CryptoAddress
                );
            },
            $response
        );
    }

    /**
     * @param string $currency
     * @return Balance
     * @throws \RuntimeException
     */
    public function getBalance(string $currency): Balance
    {
        $balance = $this->call('account/getbalance', [
            'currency' => $currency
        ]);

        return new Balance(
            (string) $balance->Currency,
            (float)  $balance->Balance,
            (float)  $balance->Available,
            (float)  $balance->Pending,
            (string) $balance->CryptoAddress
        );
    }

    /**
     * @param string $currency
     * @return Address
     * @throws \RuntimeException
     */
    public function getDepositAddress(string $currency): Address
    {
        $response = $this->call('account/getdepositaddress', [
            'currency' => $currency
        ]);

        return new Address($currency, $response->Address);
    }

    /**
     * @param Money $amount
     * @param Address $address
     * @param null|string $paymentId (optional, used for CryptoNotes/BitShareX/Nxt)
     * @return string uuid of the transaction
     * @throws \InvalidArgumentException
     */
    public function withdraw(Money $amount, Address $address, ?string $paymentId = null): string
    {
        if ($amount->getCurrency() !== $address->getCurrency()) {
            throw new \InvalidArgumentException('Address currency doesn\'t match the transaction currency');
        }

        $extraParams = [
            'currency' => $amount->getCurrency(),
            'quantity' => sprintf('%0.8f', $amount->getValue()),
            'address'  => $address,
        ];

        if ($paymentId !== null) {
            $extraParams['paymentid'] = $paymentId;
        }

        return $this->call('account/withdraw', $extraParams)->uuid;
    }

    /**
     * @param Market|null $market
     * @return Order[]
     */
    public function getOrderHistory(?Market $market = null): array
    {
        $extraParams = [];

        if ($market) {
            $extraParams['market'] = $market->getFromCurrency().'-'.$market->getToCurrency();
        }

        $response = $this->call('account/getorderhistory', $extraParams);

        return array_map(
            function ($order) {
                return new Order(
                    (string) $order->OrderUuid,
                    (string) $order->Exchange,
                    (string) $order->TimeStamp,
                    (string) $order->OrderType,
                    (float)  $order->Limit,
                    (float)  $order->Quantity,
                    (float)  $order->QuantityRemaining,
                    (float)  $order->Commission,
                    (float)  $order->Price,
                    (float)  $order->PricePerUnit,
                    (bool)   $order->IsConditional,
                    (string) $order->Condition,
                    (float)  $order->ConditionTarget,
                    (bool)   $order->ImmediateOrCancel
                );
            },
            $response
        );
    }

    public function getOrder(string $uuid): Order
    {
        $response = $this->call('account/getorder', [
            'uuid' => $uuid
        ]);

        // TODO: Add missing properties to Order class
    }

    /**
     * @param null|string $currency
     * @return Withdrawal[]
     */
    public function getWithdrawalHistory(?string $currency = null): array
    {
        $extraParams = [];

        if ($currency) {
            $extraParams['currency'] = $currency;
        }

        $response = $this->call('account/getwithdrawalhistory', $extraParams);

        return array_map (
            function ($transfer) {
                return new Withdrawal(
                    (string) $transfer->PaymentUuid,
                    (string) $transfer->Currency,
                    (float)  $transfer->Amount,
                    (string) $transfer->Address,
                    (bool)   $transfer->Opened,
                    (bool)   $transfer->Authorized,
                    (bool)   $transfer->PendingPayment,
                    (float)  $transfer->TxCost,
                    (string) $transfer->TxId,
                    (bool)   $transfer->Canceled,
                    (bool)   $transfer->InvalidAddress
                );
            },
            $response
        );
    }

    /**
     * @param null|string $currency
     * @return Payment[]
     */
    public function getDepositHistory(?string $currency = null): array
    {
        $extraParams = [];

        if ($currency) {
            $extraParams['currency'] = $currency;
        }

        $response = $this->call('account/getdeposithistory', $extraParams);

        return array_map (
            function ($payment) {
                return new Payment(
                    (int)    $payment->Id,
                    (float)  $payment->Amount,
                    (string) $payment->Currency,
                    (int)    $payment->Confirmations,
                    (string) $payment->LastUpdated,
                    (string) $payment->TxId,
                    (string) $payment->CryptoAddress
                );
            },
            $response
        );
    }
}