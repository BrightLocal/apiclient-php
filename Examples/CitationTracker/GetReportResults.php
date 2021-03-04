<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v2/ct/get-results', [
    'report-id' => 2457
]);
print_r($response->getResult());
