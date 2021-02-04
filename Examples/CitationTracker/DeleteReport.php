<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->post('/v2/ct/delete', [
    'report-id' => 682
]);
var_dump($response->getResult());
if ($response->isSuccess()) {
    echo 'Successfully deleted report.' . PHP_EOL;
}
