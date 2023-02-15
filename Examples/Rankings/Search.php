<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;
use BrightLocal\Exceptions\BatchAddJobException;

$searchEngine = 'google';
// setup API wrapper
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
// Step 1: Create a new batch
$batch = $api->createBatch();
printf('Created batch ID %d%s', $batch->getId(), PHP_EOL);
// Step 2: Add search jobs to batch
$searches = [
    [
        'search-engine'   => $searchEngine,
        'country'         => 'USA',
        'google-location' => 'New York, NY',
        'search-term'     => 'restaurant new york',
        'urls'            => json_encode(['le-bernardin.com']),
        'business-names'  => json_encode(['Le Bernardin']),
    ], [
        'search-engine'   => $searchEngine,
        'country'         => 'USA',
        'google-location' => 'New York, NY',
        'search-term'     => 'restaurant manhattan',
        'urls'            => json_encode(['le-bernardin.com']),
        'business-names'  => json_encode(['Le Bernardin']),
    ], [
        'search-engine'   => $searchEngine,
        'country'         => 'USA',
        'google-location' => 'New York, NY',
        'search-term'     => 'restaurant 10019',
        'urls'            => json_encode(['le-bernardin.com']),
        'business-names'  => json_encode(['Le Bernardin'])
    ],
];
foreach ($searches as $search) {
    try {
        $response = $batch->addJob('/v4/rankings/search', $search);
        printf('Added job with ID %d%s', $response->getResult()['job-id'], PHP_EOL);
    } catch (BatchAddJobException $exception) {
        printf('Error, job for search engine "%s" not added. Message: %s%s', $searchEngine, $exception->getMessage(), PHP_EOL);
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
