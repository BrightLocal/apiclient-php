<?php
require '../../vendor/autoload.php';

use BrightLocal\Api;
use BrightLocal\Exceptions\BatchAddJobException;

$directories = ['google', 'citysearch', 'dexknows'];
// setup API wrapper
//$api = new Api('1a3c2fa6735f089a2a1dd4fa11067807383bd08c', '5a0ae446a98a1');
$api = new Api('112dec343c6dc9fe9517d40b728fb84724cd44a0', '5a0ae446a98a1', 'http://tools.local-brightlocal.com/seo-tools/api');
// Step 1: Create a new batch
$batch = $api->createBatch();
printf('Created batch ID %d%s', $batch->getId(), PHP_EOL);
// Step 2: Add directory jobs to batch
foreach ($directories as $directory) {
    try {
        $response = $batch->addJob('/v4/ld/fetch-profile-url', [
            'local-directory' => $directory,
            'business-names'  => 'Eleven Madison Park',
            'country'         => 'USA',
            'city'            => 'New York',
            'postcode'        => '10010'
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
} while (!in_array($response->getResult()['status'], ['Stopped', 'Finished']));
print_r($response->getResult());

