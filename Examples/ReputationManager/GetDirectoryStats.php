<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$reportId = 141;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v4/rf/' . $reportId . '/directories/stats');
print_r($response->getResult());
