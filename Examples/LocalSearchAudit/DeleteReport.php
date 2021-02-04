<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->delete('/v4/lscu', [
    'report-id' => 860
]);
var_dump($response->getResult());
if ($response->isSuccess()) {
    echo 'Successfully deleted location.' . PHP_EOL;
}
