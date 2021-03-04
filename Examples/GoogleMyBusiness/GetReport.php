<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$reportId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v4/gpw/' . $reportId);
print_r($response->getResult());
