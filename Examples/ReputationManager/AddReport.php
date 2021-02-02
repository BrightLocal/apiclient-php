<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v4/rf/add';
$response = $api->post($resource, [
    'location-id'       => 1,
    'report-name'       => 'Le Bernardin',
    'business-name'     => 'Le Bernardin',
    'contact-telephone' => '+1 212-554-1515',
    'address1'          => '155 West 51st Street',
    'address2'          => '',
    'city'              => 'New York',
    'postcode'          => '10019',
    'country'           => 'USA' // USA only
]);
print_r($response->getResult());
