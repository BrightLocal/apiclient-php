<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/lsrc/update', [
    'location-id'       => 1,
    'campaign-id'       => 9907,
    'name'              => 'Le Bernardin',
    'schedule'          => 'Adhoc',
    'search-terms'      => 'Restaurant\nfood+nyc\ndelivery+midtown+manhattan',
    'website-addresses' => '["le-bernardin.com", "le-bernardin2.com"]',
    'search-engines'    => 'google,google-mobile,google-local,bing,bing-local'
]);
print_r($response->getResult());
