<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$locationId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->put('/v2/clients-and-locations/locations/' . $locationId, [
    'name'                 => 'Le Bernardin',
    'url'                  => 'le-bernardin.com',
    'location-reference'   => 'LE-BERNADIN-10019',
    'business-category-id' => 605,
    'country'              => 'USA', // 3 letter iso code
    'address1'             => '155 West 51st Street',
    'address2'             => '',
    'region'               => 'NY', // State or Region
    'city'                 => 'New York',
    'postcode'             => '10019',
    'telephone'            => '+1 212-554-1515',
    'opening-hours'        => [
        'regular' => [
            'apply-to-all' => true,
            'mon'          => [
                'status' => 'open',
                'hours'  => [
                    [
                        'start' => '10:00',
                        'end'   => '18:00',
                    ]
                ],
            ],
        ],
    ],
]);
print_r($response->getResult());
