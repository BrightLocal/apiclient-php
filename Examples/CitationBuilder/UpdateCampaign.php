<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$campaignId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->put('/v4/cb/' . $campaignId, [
    'location_id'          => 1,
    'campaign_name'        => 'Le Bernardin',
    'business_name'        => 'Le Bernardin',
    'website_address'      => 'le-bernardin.com',
    'campaign_country'     => 'USA',
    'campaign_city'        => 'New York',
    'campaign_state'       => 'NY',
    'business_category_id' => 605,
    'business_categories'  => '["restaurant", "cafe"]',
    'address1'             => '155 West 51st Street',
    'address2'             => '',
    'city'                 => 'New York',
    'postcode'             => '10019',
    'contact_name'         => 'Bloggs',
    'contact_firstname'    => 'Joe',
    'contact_telephone'    => '+1 212-554-1515',
    'contact_email'        => 'joe.bloggs@test.com',
    'payment_methods'      => [
        'visa',
        'paypal',
    ],
    'social_profile_links' => [
        'facebook' => 'https://en-gb.facebook.com/brightlocal/',
        'twitter'  => 'https://twitter.com/bright_local',
    ],
]);
print_r($response->getResult());
