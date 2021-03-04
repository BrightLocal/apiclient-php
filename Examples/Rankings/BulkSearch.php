<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;
use BrightLocal\Exceptions\BatchAddJobException;

$directory = 'google';
// setup API wrapper
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
// Step 1: Create a new batch
$batch = $api->createBatch();
printf('Created batch ID %d%s', $batch->getId(), PHP_EOL);
// Step 2: Add directory jobs to batch
$searches = [
    'restaurant new york',
    'restaurant manhattan',
    'restaurant 10019',
];
try {
    $response = $batch->addJob('/v4/rankings/bulk-search', [
        'search-engine'   => $directory,
        'country'         => 'USA',
        'google-location' => 'New York, NY',
        'search-terms'    => json_encode($searches),
        'urls'            => json_encode(['le-bernardin.com']),
        'business-names'  => json_encode(['Le Bernardin'])
    ]);
    printf('Added job with ID %d%s', $response->getResult()['job-id'], PHP_EOL);
} catch (BatchAddJobException $exception) {
    printf('Error, job for directory "%s" not added. Message: %s%s', $directory, $exception->getMessage(), PHP_EOL);
}
// Commit batch (to indicate that all jobs have been added and that processing should start)
$batch->commit();
printf('Batch committed successfully, awaiting results.%s', PHP_EOL);
do {
    sleep(5);
    $response = $batch->getResults();
} while (!in_array($response->getResult()['status'], ['Stopped', 'Finished'], true));
print_r($response->getResult());
