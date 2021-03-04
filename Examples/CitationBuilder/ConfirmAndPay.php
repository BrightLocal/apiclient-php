<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/cb/confirm-and-pay', [
    'campaign_id'       => 1,
    'package_id'        => 'cb15',
    'autoselect'        => 'N',
    'remove-duplicates' => 'Y',
    'aggregators'       => json_encode(['foursquare']),
    'citations'         => json_encode([
        'brownbook.net', 'bing.com', 'manta.com', 'yell.com', 'accessplace.com', 'bizfo.co.uk',
        'bizwiki.co.uk', 'citylocal.co.uk', 'cylex-uk.co.uk', 'where2go.com', 'yelp.co.uk', 'scoot.co.uk',
        'restaurants.co.uk', 'opendi.co.uk', 'misterwhat.co.uk'
    ]),
    'notes'             => 'Some very important notes'
]);
print_r($response->getResult());
