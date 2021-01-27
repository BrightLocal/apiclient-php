<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = "/v2/clients-and-locations/locations/search";
$response = $api->get($resource, [
    'q' => 'BrightLocal'
]);
print_r($response->getResult());
