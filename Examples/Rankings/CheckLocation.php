<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v4/rankings/check-location', [
    'search-engine' => 'google',
    'country'       => 'USA',
    'location'      => 'New York, NY'
]);
var_dump($response->getResult());
