<?php

namespace BrightLocal;

use BrightLocal\Exceptions\BatchAddJobException;
use BrightLocal\Exceptions\BatchCommitException;
use BrightLocal\Exceptions\BatchCreateException;

class Batch {

    protected Api $api;

    protected int $batchId;

    public function __construct(Api $api) {
        $this->api = $api;
    }

    public function setId(int $batchId) {
        $this->batchId = $batchId;
    }

    public function getId(): int {
        return $this->batchId;
    }

    public function create(bool $stopOnJobError = false, ?string $callBackUrl = null): Batch {
        $params = ['stop-on-job-error' => (int) $stopOnJobError];
        if (!empty($callBackUrl)) {
            $params['callback'] = $callBackUrl;
        }
        $response = $this->api->post('/v4/batch', $params);
        if (!$response->isSuccess() || (isset($response->getResult()['batch-id']) && !is_int($response->getResult()['batch-id']))) {
            throw new BatchCreateException(sprintf('Batch not created. Errors:%s', print_r($response->getResult()['errors'], true)));
        }
        $this->setId((int) $response->getResult()['batch-id']);
        return $this;
    }

    public function commit(): bool {
        $response = $this->api->put('/v4/batch', [
            'batch-id' => $this->batchId
        ]);
        if (!$response->isSuccess()) {
            throw new BatchCommitException(sprintf('An error occurred and we aren\'t able to commit the batch. Errors:%s', print_r($response->getResult()['errors'], true)));
        }
        return $response->isSuccess();
    }

    public function addJob(string $resource, array $params = []): Response {
        $params['batch-id'] = $this->batchId;
        $response = $this->api->post($resource, $params);
        if(!$response->isSuccess()){
            throw new BatchAddJobException(sprintf('Job not added to the batch. Errors:%s', print_r($response->getResult()['errors'], true)));
        }
        return $response;
    }

    public function getResults(): Response {
        return $this->api->get('/v4/batch', [
            'batch-id' => $this->batchId
        ]);
    }

    public function delete(): bool {
        $results = $this->api->delete('/v4/batch', [
            'batch-id' => $this->batchId
        ]);
        return $results->isSuccess();
    }
}
