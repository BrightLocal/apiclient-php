<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/ct/run', [
    'report-id' => 682
]);
print_r($response->getResult());
