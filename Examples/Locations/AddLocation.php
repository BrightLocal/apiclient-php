<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/clients-and-locations/locations/', [
    'name'                 => 'Le Bernardin',
    'location-reference'   => 'LE-BERNARDIN-10019',
    'url'                  => 'le-bernardin.com',
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
            'apply-to-all' => false,
            'mon'          => [
                'status' => 'open',
                'hours'  => [
                    [
                        'start' => '10:00',
                        'end'   => '18:00',
                    ],
                ],
            ],
            'tue'          => [
                'status' => 'split',
                'hours'  => [
                    [
                        'start' => '10:00',
                        'end'   => '12:00',
                    ],
                    [
                        'start' => '13:00',
                        'end'   => '18:00',
                    ]
                ],
            ],
            'wed'          => [
                'status' => '24hrs',
                'hours'  => [],
            ],
            'thu'          => [
                'status' => 'open',
                'hours'  => [
                    [
                        'start' => '10:00',
                        'end'   => '18:00',
                    ],
                ],
            ],
            'fri'          => [
                'status' => 'open',
                'hours'  => [
                    [
                        'start' => '10:00',
                        'end'   => '18:00',
                    ],
                ],
            ],
            'sat'          => [
                'status' => 'closed',
                'hours'  => [
                    [],
                ],
            ],
            'sun'          => [
                'status' => 'closed',
                'hours'  => [],
            ],
        ],
        'special' => [
            [
                'date'   => '2021-01-27',
                'status' => 'closed',
                'hours'  => [],
            ],
        ],
    ],
]);
print_r($response->getResult());
