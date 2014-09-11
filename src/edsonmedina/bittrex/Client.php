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

	private function callPublic ($query)
	{
		$uri = $this->baseUrl.'public/'.$query;

		$ch = curl_init ($uri);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		return json_decode($result);
	}

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

	private function callAccount ($query)
	{
		$uri = $this->baseUrl.'account/'.$query.'&apikey='.$this->apiKey;

		$ch = curl_init ($uri);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);

		return json_decode($result);
	}

	public function getMarkets ()
	{
		return $this->callPublic ('getmarkets');
	}

	public function getCurrencies ()
	{
		return $this->callPublic ('getcurrencies');
	}

	public function getMarketSummaries ()
	{
		return $this->callPublic ('getmarketsummaries');
	}

	public function getMarketSummary ($market)
	{
		return $this->callPublic ('getmarketsummary?market='.$market);
	}

	public function getOrderBook ($market, $type, $depth = 20)
	{
		return $this->callPublic ('getorderbook?market='.$market.'&type='.$type.'&depth='.$depth);
	}

	public function getMarketHistory ($market, $count = 20)
	{
		return $this->callPublic ('getmarkethistory?market='.$market.'&count='.$count);
	}
}
