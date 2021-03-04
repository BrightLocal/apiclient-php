<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->put('/v4/lscu/run', [
    'report-id' => 860
]);
var_dump($response->getResult());
