<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$clientId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v1/clients-and-locations/clients/' . $clientId;
$response = $api->put($resource, [
    'name'        => 'Le Bernardin',
    'company-url' => 'le-bernardin.com'
]);
print_r($response->getResult());
