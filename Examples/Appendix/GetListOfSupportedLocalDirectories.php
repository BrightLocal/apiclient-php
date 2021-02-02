<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$country = 'GBR';
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$responseForAll = $api->get('v1/directories/all');
print_r($responseForAll->getResult());
//$responseByCountry = $api->get('v1/directories/' . $country);
//print_r($responseByCountry->getResult());
