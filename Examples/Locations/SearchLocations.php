<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v2/clients-and-locations/locations/search', [
    'q' => 'BrightLocal'
]);
print_r($response->getResult());
