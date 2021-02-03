<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/ct/update', [
    'location-id'       => 1,
    'report-id'         => 682,
    'report-name'       => 'Le Bernardin',
    'business-name'     => 'Le Bernardin',
    'address1'          => '155 West 51st Street',
    'address2'          => 'The Equitable Bldg',
    'business-location' => 'New York, NY',
    'phone'             => '+1 212-554-1515',
    'website'           => 'le-bernardin.com',
    'business-type'     => 'Restaurant',
    'state-code'        => 'NY'
]);
print_r($response->getResult());
