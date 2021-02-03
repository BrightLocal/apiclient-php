<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/cb/upload/<campaignId>/<imageType>', [
    'file' => fopen('/path/to/image.jpg', 'r')
]);
print_r($response->getResult());
