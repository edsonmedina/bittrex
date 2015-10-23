PHP wrapper class for Bittrex API 
=======

This class is a wrapper for the Bittrex altcoin trader platform API (https://bittrex.com/home/api). You can use it to check market values, do tradings with your wallet, deposit and withdraw coins, write your own trading bot, etc

Requirements
======
* You obviously need a bittrex account.
* You need to create an API key on your account settings

Usage
======
	use edsonmedina\bittrex\Client;

	$key = '4bec433f95e54562aeeefae92ebedb84'; // use your key and secret
	$secret = '6171690af7364ea2a951dc85d00e1130';

	$b = new Client ($key, $secret);
	
	$list = $b->getOrderHistory ();

Documentation
======
TODO




