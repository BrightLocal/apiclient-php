<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v1/geo-locations/bing', [
    'country'  => 'USA',
    'location' => '12555'
]);
var_dump($response->getResult());
