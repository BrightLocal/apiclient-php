<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = "/v1/clients-and-locations/clients/search";
$response = $api->get($resource, [
    'q' => 'BrightLocal'
]);
print_r($response->getResult());
