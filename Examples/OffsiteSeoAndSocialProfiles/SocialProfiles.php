<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;
use BrightLocal\Exceptions\BatchAddJobException;

// setup API wrapper
$api = new Api('<YOUR_API_KEY>', '<YOUR_API_SECRET>');
// Step 1: Create a new batch
$batch = $api->createBatch();
printf('Created batch ID %d%s', $batch->getId(), PHP_EOL);
// Step 2: Add directory jobs to batch
try {
    $response = $batch->addJob('/v4/social/profiles', [
        'website-url'      => 'http://www.gramercytavern.com/',
        'fetch-twitter'    => 'yes',
        'fetch-facebook'   => 'yes',
        'fetch-foursquare' => 'yes',
        'business-names'   => '["Gramercy Tavern"]',
        'street-address'   => '42 E 20th St',
        'city'             => 'New York',
        'state-code'       => 'NY',
        'telephone'        => '(212) 477-0777',
        'postcode'         => '10003',
        'country'          => 'USA',
    ]);
    printf('Added job with ID %d%s', $response->getResult()['job-id'], PHP_EOL);
} catch (BatchAddJobException $exception) {
    printf('Error, job not added. Message: %s%s', $exception->getMessage(), PHP_EOL);
}
// Commit batch (to indicate that all jobs have been added and that processing should start)
$batch->commit();
printf('Batch committed successfully, awaiting results.%s', PHP_EOL);
do {
    sleep(5);
    $response = $batch->getResults();
} while (!in_array($response->getResult()['status'], ['Stopped', 'Finished'], true));
print_r($response->getResult());
