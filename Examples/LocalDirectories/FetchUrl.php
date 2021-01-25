<?php
require '../auth.php';
require '../../vendor/autoload.php';

use BrightLocal\Api;

$directories = ['google', 'citysearch', 'dexknows'];
// setup API wrappers
$api = new Api(API_KEY, API_SECRET, API_ENDPOINT);
// Step 1: Create a new batch
$batchId = $api->createBatch();
if (!is_int($batchId)) {
    printf('Batch not created!%s', PHP_EOL);
    exit;
}
printf('Created batch ID %d%s', $batchId, PHP_EOL);
// Step 2: Add directory jobs to batch
foreach ($directories as $directory) {
    $result = $api->post('/v4/ld/fetch-profile-url', [
        'batch-id'        => $batchId,
        'local-directory' => $directory,
        'business-names'  => 'Eleven Madison Park',
        'country'         => 'USA',
        'city'            => 'New York',
        'postcode'        => '10010'
    ]);
    if ($result['success']) {
        printf('Added job with ID %d%s', $result['job-id'], PHP_EOL);
    } else {
        printf('Error, job for directory "%s" not added. Reasons: %s%s', $directory, print_r($result['errors'], true), PHP_EOL);
    }
}
// Step 3: Commit batch (to signal all jobs added, processing starts)
$success = $api->commitBatch($batchId);
if (!$success) {
    echo 'Can not commit the batch.' . PHP_EOL;
    exit;
}
printf('Batch committed successfully, waiting results.%s',  PHP_EOL);
do {
    sleep(5);
    $response = $api->getBatchResults($batchId);
} while (!in_array($response['status'], ['Stopped', 'Finished']));
print_r($response);

