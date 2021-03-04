<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$clientId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->put('/v1/clients-and-locations/clients/' . $clientId, [
    'name'        => 'Le Bernardin',
    'company-url' => 'le-bernardin.com'
]);
print_r($response->getResult());
