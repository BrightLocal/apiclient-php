<?php
namespace BrightLocal;

use BrightLocal\Exceptions\BatchAddJobException;
use BrightLocal\Exceptions\BatchCommitException;
use BrightLocal\Exceptions\BatchCreateException;
use BrightLocal\Exceptions\BatchDeleteException;

class Batch {

    private Api $api;
    private int $batchId;

    public function __construct(Api $api) {
        $this->api = $api;
    }

    public function getId(): int {
        return $this->batchId;
    }

    public function getBatch(int $batchId): Batch {
        $this->batchId = $batchId;
        return $this;
    }

    /**
     * @throws BatchCreateException
     */
    public function create(bool $stopOnJobError = false, ?string $callbackUrl = null): Batch {
        $params = ['stop-on-job-error' => (int) $stopOnJobError];
        if (!empty($callbackUrl)) {
            $params['callback'] = $callbackUrl;
        }
        $response = $this->api->post('/v4/batch', $params);
        if (!$response->isSuccess() || (isset($response->getResult()['batch-id']) && !is_int($response->getResult()['batch-id']))) {
            throw new BatchCreateException('An error occurred and we weren\'t able to create the batch. ', null, null, $response->getResult()['errors']);
        }
        $this->setId((int) $response->getResult()['batch-id']);
        return $this;
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

    public function getResults(): ApiResponse {
        return $this->api->get('/v4/batch', [
            'batch-id' => $this->batchId
        ]);
    }
}
