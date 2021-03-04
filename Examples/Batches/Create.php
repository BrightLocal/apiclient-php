<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;

$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
// Step: Create a new batch
$batch = $api->createBatch();
printf('Created batch ID %d%s', $batch->getId(), PHP_EOL);
