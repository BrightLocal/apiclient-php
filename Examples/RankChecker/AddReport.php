<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v2/lsrc/add';
$response = $api->post($resource, [
    'location-id'       => 1,
    'name'              => 'Le Bernardin',
    'schedule'          => 'Adhoc',
    'search-terms'      => 'Restaurant\nfood+nyc\ndelivery+midtown+manhattan',
    'website-addresses' => '["le-bernardin.com", "le-bernardin2.com"]',
    'search-engines'    => 'google,google-mobile,google-local,bing,bing-local',
]);
print_r($response->getResult());
