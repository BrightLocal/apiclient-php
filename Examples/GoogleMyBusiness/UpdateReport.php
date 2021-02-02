<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$reportId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v4/gpw/';
$response = $api->put($resource . $reportId, [
    'location_id'       => 1,
    'business-name'     => 'Le Bernardin',
    'contact-telephone' => '+1 212-554-1515'
]);
print_r($response->getResult());
