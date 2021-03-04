<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v4/gpw/add', [
    'location_id'     => 1,
    'report_name'     => 'Le Bernardin',
    'business_names'  => 'Le Bernardin',
    'schedule'        => 'Adhoc',
    'day_of_month'    => '2',
    'report_type'     => 'with',
    'address1'        => '155 West 51st Street',
    'address2'        => '',
    'city'            => 'New York',
    'state_code'      => 'NY',
    'google_location' => 'New York, NY',
    'postcode'        => '10019',
    'phone_number'    => '+1 212-554-1515',
    'country'         => 'USA',
    'search_terms'    => '["restaurant manhattan","cafe new york"]'
]);
print_r($response->getResult());
