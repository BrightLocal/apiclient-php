<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v1/clients-and-locations/clients', [
    'name'        => 'Le Bernardin',
    'company-url' => 'le-bernardin.com'
]);
print_r($response->getResult());
