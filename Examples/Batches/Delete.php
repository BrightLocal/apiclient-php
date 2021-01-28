<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$batchId = 1;
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
$batch = $api->getBatch($batchId);
$batch->delete();
printf('Successfully deleted batch %d%s', $batchId, PHP_EOL);
