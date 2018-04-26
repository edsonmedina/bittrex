<?php

/*
 * Bittrex PHP Client Wrapper.
 *
 * (c) Edson Medina <edsonmedina@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/src/edsonmedina/bittrex/Client.php';

use edsonmedina\bittrex\Client;

$key = '4bec433f95e54562aeeefae92ebedb84';
$secret = '6171690af7364ea2a951dc85d00e1130';

$b = new Client($key, $secret);
var_dump($b->getOrderHistory());

echo "\n\n";
