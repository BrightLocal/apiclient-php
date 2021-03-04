<?php

namespace BrightLocal;

use BrightLocal\Exceptions\BatchCreateException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Utils;

class Api {

    /** API endpoint URL */
    const ENDPOINT = 'https://tools.brightlocal.com/seo-tools/api';
    /** expiry can't be more than 30 minutes (1800 seconds) */
    const MAX_EXPIRY = 1800;

    private string $endpoint;
    private string $apiKey;
    private string $apiSecret;

    public function __construct(string $apiKey, string $apiSecret, ?string $endpoint = null) {
        $this->endpoint = empty($endpoint) ? static::ENDPOINT : $endpoint;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    public function get(string $resource, array $params = []): ApiResponse {
        return $this->call($resource, $params, Methods::GET);
    }

    public function post(string $resource, array $params = []): ApiResponse {
        return $this->call($resource, $params);
    }

    public function put(string $resource, array $params = []): ApiResponse {
        return $this->call($resource, $params, Methods::PUT);
    }

    public function delete(string $resource, array $params = []): ApiResponse {
        return $this->call($resource, $params, Methods::DELETE);
    }

    /**
     * @throws BatchCreateException
     */
    public function createBatch(bool $stopOnJobError = false, ?string $callbackUrl = null): Batch {
        $params = ['stop-on-job-error' => (int) $stopOnJobError];
        if (!empty($callbackUrl)) {
            $params['callback'] = $callbackUrl;
        }
        $response = $this->post('/v4/batch', $params);
        if (!$response->isSuccess() || (isset($response->getResult()['batch-id']) && !is_int($response->getResult()['batch-id']))) {
            throw new BatchCreateException('An error occurred and we weren\'t able to create the batch. ', null, null, $response->getResult()['errors']);
        }
        return (new Batch($this, (int) $response->getResult()['batch-id']));
    }

    public function getBatch(int $batchId): Batch {
        return new Batch($this, $batchId);
    }

    private function call(string $resource, array $params = [], string $httpMethod = Methods::POST): ApiResponse {
        $resource = str_replace('/seo-tools/api', '', $resource);
        // some methods only require api key but there's no harm in also sending
        // sig and expires to those methods
        $params = array_merge($this->getAuthParams(), $params);
        $client = new Client;
        try {
            $result = $client->$httpMethod($this->endpoint . '/' . ltrim($resource, '/'), $this->getOptions($httpMethod, $params));
        } catch (RequestException $e) {
            $result = $e->getResponse();
        }
        $response = new ApiResponse($result->getStatusCode(), Utils::jsonDecode($result->getBody()
            ->getContents(), true));
        $result->getBody()->close();
        return $response;
    }

    private function getAuthParams(): array {
        $expires = (int) gmdate('U') + static::MAX_EXPIRY;
        $sig = base64_encode(hash_hmac('sha1', $this->apiKey . $expires, $this->apiSecret, true));
        return [
            'api-key' => $this->apiKey,
            'sig'     => $sig,
            'expires' => $expires
        ];
    }

    private function getOptions(string $httpMethod, array $params): array {
        if ($httpMethod === Methods::GET) {
            return ['query' => $params];
        }
        foreach ($params as $param) {
            if (is_resource($param)) {
                return ['multipart' => $this->convertToMultipart($params)];
            }
        }
        return ['form_params' => $params];
    }

    private function convertToMultipart(array $params): array {
        $multipart = [];
        foreach ($params as $key => $value) {
            $multipart[] = [
                'name'     => $key,
                'contents' => $value,
            ];
        }
        return $multipart;
    }
}
