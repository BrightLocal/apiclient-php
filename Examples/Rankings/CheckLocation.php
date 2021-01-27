<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

// setup API wrapper
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v4/rankings/check-location';
$response = $api->post($resource, [
    'search-engine' => 'google',
    'country'       => 'USA',
    'location'      => 'New York, NY',
]);
var_dump($response->getResult());
