<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$country = 'USA';
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v1/business-categories/' . $country);
print_r($response->getResult());
