<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v2/lsrc/history/get', [
    'campaign-id' => 50
]);
print_r($response->getResult());
