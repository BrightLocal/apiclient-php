<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$locationId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v2/clients-and-locations/locations/' . $locationId);
print_r($response->getResult());
