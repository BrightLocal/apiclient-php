<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->get('/v4/rf/search', [
    'q' => 'Le Bernardin'
]);
print_r($response->getResult());
