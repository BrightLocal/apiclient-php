<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$reportId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->put('/v4/rf/' . $reportId, [
    'location-id'       => 1,
    'report-name'       => 'Le Bernardin',
    'contact-telephone' => '+1 212-554-1855',
]);
print_r($response->getResult());
