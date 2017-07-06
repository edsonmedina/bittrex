<?php

namespace edsonmedina\bittrex;

use edsonmedina\bittrex\publicinfo\CurrencyInfo;
use edsonmedina\bittrex\publicinfo\Market;
use edsonmedina\bittrex\publicinfo\Ticker;

class PublicInfo
{
    const baseUrl = 'https://bittrex.com/api/v1.1/';

    /** @var \GuzzleHttp\Client */
    private $guzzle;

    static public function connect(): self
    {
        $guzzle = new \GuzzleHttp\Client([
            'base_uri' => self::baseUrl,
            'timeout' => 5
        ]);

        return new self($guzzle);
    }

    public function __construct(\GuzzleHttp\Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @param string $method
     * @param array $extraParams
     * @return mixed
     * @throws \RuntimeException
     */
    protected function call(string $method, array $extraParams = [])
    {
        $uri = self::baseUrl . $method;

        if (!empty($extraParams)) {
            $uri .= '?'.http_build_query($extraParams);
        }

        $options = [
            'headers' => [
                'User-Agent' => 'Bittrex client (github.com/edsonmedina/bittrex)',
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
     * @return Market[]
     */
    public function getMarkets(): array
    {
        $response = $this->call('public/getmarkets');

        return array_map(
            function ($market) {
                return new Market(
                    (string) $market->MarketCurrency,
                    (string) $market->BaseCurrency,
                    (string) $market->MarketCurrencyLong,
                    (string) $market->BaseCurrencyLong,
                    (float)  $market->MinTradeSize,
                    (string) $market->MarketName,
                    (bool)   $market->IsActive,
                    (string) $market->Created
                );
            },
            $response
        );
    }

    /**
     * @return CurrencyInfo[]
     */
    public function getCurrencies(): array
    {
        $response = $this->call('public/getcurrencies');

        return array_map(
            function ($currencyInfo) {
                return new CurrencyInfo(
                    (string) $currencyInfo->Currency,
                    (string) $currencyInfo->CurrencyLong,
                    (int)    $currencyInfo->MinConfirmation,
                    (float)  $currencyInfo->TxFee,
                    (bool)   $currencyInfo->IsActive,
                    (string) $currencyInfo->CoinType,
                    (string) $currencyInfo->BaseAddress
                );
            },
            $response
        );
    }

    public function getTicker($market)
    {
        if (empty($market)) {
            throw new \InvalidArgumentException("Market can't be empty");
        }

        $response = $this->call('public/getticker', [
            'market' => $market
        ]);

        list ($fromCurrency, $toCurrency) = explode('-', $market);

        return new Ticker(
            (string) $fromCurrency,
            (float)  $response->Bid,
            (float)  $response->Ask,
            (float)  $response->Last
        );
    }

    public function ()
    {
        
    }
}