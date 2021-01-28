<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;
use BrightLocal\Exceptions\BatchAddJobException;

$directories = [
    'https://local.google.com/place?id=2145618977980482902&use=srp&hl=en',
    'https://www.yelp.com/biz/le-bernardin-new-york',
];
// setup API wrapper
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
// Step 1: Create a new batch
$batch = $api->createBatch();
printf('Created batch ID %d%s', $batch->getId(), PHP_EOL);
// Step 2: Add directory jobs to batch
foreach ($directories as $directory) {
    try {
        $response = $batch->addJob('/v4/ld/fetch-profile-details', [
            'profile-url' => $directory,
            'country'     => 'USA'
        ]);
        printf('Added job with ID %d%s', $response->getResult()['job-id'], PHP_EOL);
    } catch (BatchAddJobException $exception) {
        printf('Error, job for directory "%s" not added. Message: %s%s', $directory, $exception->getMessage(), PHP_EOL);
    }
}
// Commit batch (to indicate that all jobs have been added and that processing should start)
$batch->commit();
printf('Batch committed successfully, awaiting results.%s', PHP_EOL);
do {
    sleep(5);
    $response = $batch->getResults();
} while (!in_array($response->getResult()['status'], ['Stopped', 'Finished'], true));
print_r($response->getResult());
