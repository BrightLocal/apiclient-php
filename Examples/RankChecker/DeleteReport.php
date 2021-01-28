<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$clientId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/lsrc/delete', [
    'campaign-id' => 9907,
]);
var_dump($response->getResult());
if (!empty($response->getResult()['success'])) {
    echo 'Successfully deleted report.' . PHP_EOL;
}
