<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v2/ct/add';
$response = $api->post($resource, [
    'location-id'       => 1,
    'report-name'       => 'Le Bernardin',
    'business-name'     => 'Le Bernardin',
    'address1'          => '155 West 51st Street',
    'address2'          => 'The Equitable Bldg',
    'business-location' => 'New York, NY',
    'postcode'          => '10020',
    'phone'             => '+1 212-554-1515',
    'website'           => 'le-bernardin.com',
    'business-type'     => 'Restaurant',
    'state-code'        => 'NY',
    'primary-location'  => '10020'
]);
print_r($response->getResult());
