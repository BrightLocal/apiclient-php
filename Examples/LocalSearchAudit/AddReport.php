<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v4/lscu', [
    'location_id'               => 1,
    'report-name'               => 'Le Bernardin',
    'business-names'            => ['Le Bernardin'],
    'website-address'           => 'le-bernardin.com',
    'address1'                  => '155 West 51st Street',
    'address2'                  => '',
    'city'                      => 'New York',
    'state-code'                => 'NY',
    'postcode'                  => '10019',
    'telephone'                 => '+1 212-554-1515',
    'country'                   => 'USA',
    'business-category'         => 'Restaurant',
    'primary-business-location' => 'NY, New York',
    'search-terms'              => ['restaurant manhattan', 'cafe new york'],
    'facebook-url'              => 'https://www.facebook.com/chefericripert'
]);
print_r($response->getResult());
