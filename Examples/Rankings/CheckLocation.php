<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

// setup API wrapper
$api = new Api('1a3c2fa6735f089a2a1dd4fa11067807383bd08c', '5a0ae446a98a1');
$resource = '/v4/rankings/check-location';
$response = $api->post($resource, [
    'search-engine' => 'google',
    'country'       => 'USA',
    'location'      => 'New York, NY',
]);
var_dump($response->getResult());
