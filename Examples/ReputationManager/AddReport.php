<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v4/rf/add', [
    'location-id'       => 1,
    'report-name'       => 'Le Bernardin',
    'business-name'     => 'Le Bernardin',
    'contact-telephone' => '+1 212-554-1515',
    'address1'          => '155 West 51st Street',
    'address2'          => '',
    'city'              => 'New York',
    'postcode'          => '10019',
    'country'           => 'USA', // USA only
    'directories'       => [
        'yellowbot'   => [
            'url'     => 'https://www.yellowbot.com/le-bernardin-new-york-ny.html',
            'include' => true,
        ],
        'yellowpages' => [
            'url'     => 'https://www.yellowpages.com/new-york-ny/mip/le-bernardin-9909153',
            'include' => true,
        ],
        'yelp'        => [
            'url'     => 'https://www.yelp.com/biz/le-bernardin-new-york',
            'include' => true,
        ],
    ],
]);
print_r($response->getResult());
