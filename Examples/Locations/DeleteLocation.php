<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$locationId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->delete('/v2/clients-and-locations/locations/' . $locationId);
var_dump($response->getResult());
if ($response->isSuccess()) {
    echo 'Successfully deleted location.' . PHP_EOL;
}
