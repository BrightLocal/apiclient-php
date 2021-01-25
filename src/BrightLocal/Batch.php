<?php

namespace BrightLocal;

use Exception;

class Batch {

    protected Api $api;

    public function __construct(Api $api) {
        $this->api = $api;
    }

    /**
     * @param bool $stopOnJobError
     * @param string|null $callBackUrl
     * @return bool|int
     * @throws Exception
     */
    public function create(bool $stopOnJobError = false, ?string $callBackUrl = null) {
        $params = ['stop-on-job-error' => (int) $stopOnJobError];
        if (!empty($callBackUrl)) {
            $params['callback'] = $callBackUrl;
        }
        $result = $this->api->call('/v4/batch', $params);
        return $result['success'] ? $result['batch-id'] : false;
    }

    /**
     * @param int $batchId
     * @return bool
     * @throws Exception
     */
    public function commit(int $batchId): bool {
        $result = $this->api->call('/v4/batch', [
            'batch-id' => $batchId
        ], Methods::PUT);
        return $result['success'];
    }

    /**
     * @param int $batchId
     * @return array
     * @throws Exception
     */
    public function get_results(int $batchId): array {
        return $this->api->call('/v4/batch', [
            'batch-id' => $batchId
        ], Methods::GET);
    }

    /**
     * @param int $batchId
     * @return bool
     * @throws Exception
     */
    public function delete(int $batchId): bool {
        $results = $this->api->call('/v4/batch', array(
            'batch-id' => $batchId
        ), Methods::DELETE);
        return $results['success'];
    }
}
