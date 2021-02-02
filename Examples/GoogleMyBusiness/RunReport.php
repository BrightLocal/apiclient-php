<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$reportId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v4/gpw/run';
$response = $api->put($resource . $reportId, [
    'report-id' => 860
]);
print_r($response->getResult());
