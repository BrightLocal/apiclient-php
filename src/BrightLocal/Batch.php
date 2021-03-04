<?php

namespace BrightLocal;

use BrightLocal\Exceptions\BatchAddJobException;
use BrightLocal\Exceptions\BatchCommitException;
use BrightLocal\Exceptions\BatchDeleteException;
use BrightLocal\Exceptions\BatchNotFoundException;
use BrightLocal\Exceptions\BatchStopException;

class Batch {

    private Api $api;
    private ?int $batchId;

    public function __construct(Api $api, ?int $batchId = null) {
        $this->api = $api;
        $this->batchId = $batchId;
    }

    public function getId(): int {
        return $this->batchId;
    }

    /**
     * @throws BatchCommitException
     */
    public function commit(): bool {
        $response = $this->api->put('/v4/batch', [
            'batch-id' => $this->batchId
        ]);
        if (!$response->isSuccess()) {
            throw new BatchCommitException('An error occurred and we aren\'t able to commit the batch.', null, null, $response->getResult()['errors']);
        }
        return $response->isSuccess();
    }

    /**
     * @throws BatchAddJobException
     */
    public function addJob(string $resource, array $params = []): ApiResponse {
        $params['batch-id'] = $this->batchId;
        $response = $this->api->post($resource, $params);
        if (!$response->isSuccess()) {
            throw new BatchAddJobException('An error occurred and we weren\'t able to add the job to the batch.', null, null, $response->getResult()['errors']);
        }
        return $response;
    }

    /**
     * @throws BatchDeleteException
     */
    public function delete(): bool {
        $response = $this->api->delete('/v4/batch', [
            'batch-id' => $this->batchId
        ]);
        if (!$response->isSuccess()) {
            throw new BatchDeleteException('An error occurred and we weren\'t able to delete the batch.', null, null, $response->getResult()['errors']);
        }
        return $response->isSuccess();
    }

    /**
     * @throws BatchStopException
     */
    public function stop(): bool {
        $response = $this->api->put('/v4/batch/stop', [
            'batch-id' => $this->batchId
        ]);
        if (!$response->isSuccess()) {
            throw new BatchStopException('An error occurred and we weren\'t able to stop the batch.', null, null, $response->getResult()['errors']);
        }
        return $response->isSuccess();
    }

    /**
     * @throws BatchNotFoundException
     */
    public function getResults(): ApiResponse {
        $response = $this->api->get('/v4/batch', [
            'batch-id' => $this->batchId
        ]);
        if (!$response->isSuccess()) {
            throw new BatchNotFoundException('An error occurred and we weren\'t able to find the batch.', null, null, $response->getResult()['errors']);
        }
        return $response;
    }
}
