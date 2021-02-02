<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$country = 'USA';
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v1/business-categories/';
$response = $api->get($resource . $country);
print_r($response->getResult());
