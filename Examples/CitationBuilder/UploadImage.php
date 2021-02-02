<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$resource = '/v2/cb/upload/<campaignId>/<imageType>';
$response = $api->post($resource, [
    'file' => fopen('/path/to/image.jpg', 'r')
]);
print_r($response->getResult());
