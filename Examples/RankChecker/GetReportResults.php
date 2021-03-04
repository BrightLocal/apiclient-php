<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v2/lsrc/results/get', [
    'campaign-id' => 9636
]);
print_r($response->getResult());
