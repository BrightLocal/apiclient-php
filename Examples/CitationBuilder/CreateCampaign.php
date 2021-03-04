<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$briefDescription = 'Born in Paris in 1972 by sibling duo Maguy and Gilbert Le Coze, Le Bernardin only served fish: 
Fresh, simple and prepared with respect.';
$fullDescription = 'The restaurant has held three stars from the Michelin Guide since its 2005 New York launch and 
currently ranks 24 on the World’s 50 Best Restaurants list. The New York Zagat Guide has recognized Le Bernardin as top rated 
in the category of “Best Food” for the last nine consecutive years, and in 2015 was rated by the guide as New York 
City’s top restaurant for food and service. Le Bernardin has earned seven James Beard Awards since 1998 including 
“Outstanding Restaurant of the Year”.';

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v4/cb/create', [
    'location_id'            => 1,
    'campaign_name'          => 'Le Bernardin',
    'business_name'          => 'Le Bernardin',
    'website_address'        => 'le-bernardin.com',
    'campaign_country'       => 'USA',
    'campaign_city'          => 'New York',
    'campaign_state'         => 'NY',
    'business_category_id'   => 605,
    'business_categories'    => '["restaurant", "cafe"]',
    'address1'               => '155 West 51st Street',
    'address2'               => '',
    'city'                   => 'New York',
    'region'                 => 'New York, USA',
    'postcode'               => '10019',
    'contact_name'           => 'Bloggs',
    'contact_firstname'      => 'Joe',
    'contact_telephone'      => '+1 212-554-1515',
    'contact_email'          => 'joe.bloggs@test.com',
    'brief_description'      => $briefDescription,
    'full_description'       => $fullDescription,
    'employees_number'       => 35,
    'formation_date'         => '01-2021',
    'opening_hours'          => [
        'regular' => [
            'apply_to_all' => false,
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
                    ],
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
    'social_profile_links'   => [
        'facebook'  => 'https://en-gb.facebook.com/brightlocal/',
        'twitter'   => 'https://twitter.com/bright_local',
        'linkedin'  => 'https://uk.linkedin.com/company/bright-local-seo',
        'instagram' => '',
        'pinterest' => 'https://www.pinterest.co.uk/brightlocal/',
    ],
    'white_label_profile_id' => 12
]);
print_r($response->getResult());
