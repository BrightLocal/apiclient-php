<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$reportId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$response = $api->delete('/v4/gpw/' . $reportId);
var_dump($response->getResult());
if ($response->isSuccess()) {
    echo 'Successfully deleted report.' . PHP_EOL;
}
