<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$reportId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v4/rf/';
$response = $api->put($resource . $reportId, [
]);
print_r($response->getResult());
