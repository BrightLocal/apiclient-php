<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->put('/v4/lscu', [
    'location-id'               => 1,
    'report-id'                 => 1,
    'postcode'                  => '10019',
    'telephone'                 => '+1 212-554-1515',
    'country'                   => 'USA',
    'business-category'         => 'Restaurant',
    'primary-business-location' => 'NY, New York',
    'search-terms'              => '["restaurant manhattan","cafe new york"]'
]);
print_r($response->getResult());
