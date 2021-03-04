<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v1/clients-and-locations/clients/search', [
    'q' => 'BrightLocal'
]);
print_r($response->getResult());
