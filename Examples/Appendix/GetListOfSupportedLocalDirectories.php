<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$responseForAll = $api->get('v1/directories/all');
print_r($responseForAll->getResult());

$country = 'USA';
$responseByCountry = $api->get('v1/directories/' . $country);
print_r($responseByCountry->getResult());
