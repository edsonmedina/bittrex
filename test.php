<?php

require __DIR__.'/vendor/autoload.php';

use edsonmedina\bittrex\Account;
use edsonmedina\bittrex\valueobjects\Market;

$apiKey = '9e84f91bdd9c4d1486a5393ada5af523';
$secret = '39b5b5f00a5b47b5a62439bd7b0216b6';

$bittrex = Account::connect($apiKey, $secret);

//$balances = $bittrex->getBalances();
//$balances = $bittrex->getBalance('XPY');
//$balances = $bittrex->getDepositAddress('RDD');
//$balances = $bittrex->getOrderHistory(new Market('BTC', 'DOPE'));
$balances = $bittrex->getOrderHistory(new Market('BTC', 'DOPE'));

print_r ($balances);

echo "\n";