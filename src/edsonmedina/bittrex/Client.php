<?php

/**
 * Bittrex API wrapper class
 * @author Edson Medina <edsonmedina@gmail.com>
 */

namespace edsonmedina\bittrex;

class Client
{
	private $version = 'v1.1';
	private $baseUrl;
	private $apiKey;
	private $apiSecret;

	public function __construct ($apiKey, $apiSecret)
	{
		$this->apiKey = $apiKey;
		$this->apiSecret = $apiSecret;
		$this->baseUrl = 'https://bittrex.com/api/'.$this->version.'/';
	}

    /**
     * Invoke method in the /public/ namespace
     * @param string $query ie: method?param=val
     * @return array
     */
	private function callPublic ($query)
	{
		$uri = $this->baseUrl.'public/'.$query;

		$ch = curl_init ($uri);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		return json_decode($result);
	}

    /**
     * Invoke method in the /market/ namespace
     * @param string $query ie: method?param=val
     * @return array
     */
	private function callMarket ($query)
	{
		$uri = $this->baseUrl.'market/'.$query.'&nounce='.time();
		$sign = hash_hmac ('sha512', $uri, $this->apiSecret);

		$ch = curl_init ($uri);
		curl_setopt ($ch, CURLOPT_HTTPHEADER, array('apisign:'.$sign));
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		return json_decode($result);
	}

    /**
     * Invoke method in the /account/ namespace
     * @param string $query ie: method?param=val
     * @return array
     */
	private function callAccount ($query)
	{
		$uri = $this->baseUrl.'account/'.$query.'&apikey='.$this->apiKey;

		$ch = curl_init ($uri);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		return json_decode($result);
	}

    /**
     * Get the open and available trading markets at Bittrex along with other meta data.
     * @return array
     */
	public function getMarkets ()
	{
		return $this->callPublic ('getmarkets');
	}

    /**
     * Get all supported currencies at Bittrex along with other meta data.
     * @return array
     */
	public function getCurrencies ()
	{
		return $this->callPublic ('getcurrencies');
	}

    /**
     * Get the current tick values for a market.
     * @param string $market    literal for the market (ex: BTC-LTC)
     * @return array
     */
	public function getTicker ($market)
	{
		return $this->callPublic ('getticker?market='.$market);
	}

    /**
     * Get the last 24 hour summary of all active exchanges
     * @return array
     */
	public function getMarketSummaries ()
	{
		return $this->callPublic ('getmarketsummaries');
	}

    /**
     * Get the last 24 hour summary of all active exchanges
     * @param string $market    literal for the market (ex: BTC-LTC)
     * @return array
     */
	public function getMarketSummary ($market)
	{
		return $this->callPublic ('getmarketsummary?market='.$market);
	}

    /**
     * Get the orderbook for a given market
     * @param string $market  literal for the market (ex: BTC-LTC)
     * @param string $type    "buy", "sell" or "both" to identify the type of orderbook to return
     * @param integer $depth  how deep of an order book to retrieve. Max is 50.
     * @return array
     */
	public function getOrderBook ($market, $type, $depth = 20)
	{
		return $this->callPublic ('getorderbook?market='.$market.'&type='.$type.'&depth='.$depth);
	}

    /**
     * Get the latest trades that have occured for a specific market
     * @param string $market  literal for the market (ex: BTC-LTC)
     * @param integer $count  number of entries to return. Max is 50.
     * @return array
     */
	public function getMarketHistory ($market, $count = 20)
	{
		return $this->callPublic ('getmarkethistory?market='.$market.'&count='.$count);
	}
}
