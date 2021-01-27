<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v1/clients-and-locations/clients';
$response = $api->post($resource, [
    'name'        => 'Le Bernardin',
    'company-url' => 'le-bernardin.com'
]);
var_dump($response->getResult());
