<?php

require __DIR__.'/vendor/autoload.php';

use edsonmedina\bittrex\Account;
use edsonmedina\bittrex\PublicInfo;

$apiKey = '9e84f91bdd9c4d1486a5393ada5af523';
$secret = '39b5b5f00a5b47b5a62439bd7b0216b6';

//$bittrex = Account::connect($apiKey, $secret);
//$response = $bittrex->getBalances();
//$response = $bittrex->getBalance('XPY');
//$response = $bittrex->getDepositAddress('RDD');
//$response = $bittrex->getOrderHistory(new Market('BTC', 'DOPE'));
//$response = $bittrex->getOrderHistory(new Market('BTC', 'DOPE'));
//$response = $bittrex->getWithdrawalHistory();
//$response = $bittrex->getDepositHistory();

$bittrex = PublicInfo::connect();
$response = $bittrex->getMarkets();

print_r ($response);

echo "\n";