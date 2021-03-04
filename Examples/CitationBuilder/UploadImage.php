<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$campaignId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post("/v2/cb/upload/$campaignId/logo", [
    'file' => fopen('/path/to/image.jpg', 'r')
]);
print_r($response->getResult());
