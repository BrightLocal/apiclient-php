<?php

namespace BrightLocal;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Utils;

/**
 * Class Api
 *
 * @package BrightLocal
 */
class Api {

    /** API endpoint URL */
    const ENDPOINT = 'https://tools.brightlocal.com/seo-tools/api';
    /** expiry can't be more than 30 minutes (1800 seconds) */
    const MAX_EXPIRY = 1800;


    protected string $endpoint;
    protected string $apiKey;
    protected string $apiSecret;
    protected int $lastHttpCode;


    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param string|null $endpoint
     */
    public function __construct(string $apiKey, string $apiSecret, ?string $endpoint = null) {
        $this->endpoint = empty($endpoint) ? static::ENDPOINT : $endpoint;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    /**
     * @return array
     */
    public function get_auth(): array {
        $expires = (int) gmdate('U') + static::MAX_EXPIRY;
        $sig = base64_encode(hash_hmac('sha1', $this->apiKey . $expires, $this->apiSecret, true));
        return [
            'api-key' => $this->apiKey,
            'sig'     => $sig,
            'expires' => $expires
        ];
    }

    /**
     * @param string $method
     * @param array $params
     * @param string $httpMethod
     * @return array
     * @throws Exception
     */
    public function call(string $method, array $params = [], string $httpMethod = Methods::POST): array {
        if (!in_array($httpMethod, Methods::$allowedHttpMethods)) {
            throw new Exception('Invalid HTTP method specified.');
        }
        $method = str_replace('/seo-tools/api', '', $method);
        // some methods only require api key but there's no harm in also sending
        // sig and expires to those methods
        $params = array_merge($this->get_auth(), $params);
        $client = new Client;
        try {
            $result = $client->$httpMethod($this->endpoint . '/' . ltrim($method, '/'), $this->get_options($httpMethod, $params));
        } catch (RequestException $e) {
            $result = $e->getResponse();
        }
        $this->lastHttpCode = $result->getStatusCode();
        $content = $result->getBody()->getContents();
        $result->getBody()->close();
        return Utils::jsonDecode($content, true);
    }

    /**
     * @param string $method
     * @param array $params
     * @return bool|mixed
     * @throws Exception
     */
    public function get(string $method, array $params = []): array {
        return $this->call($method, $params, Methods::GET);
    }

    /**
     * @param string $method
     * @param array $params
     * @return bool|mixed
     * @throws Exception
     */
    public function post(string $method, array $params = []): array {
        return $this->call($method, $params);
    }

    /**
     * @param string $method
     * @param array $params
     * @return bool|mixed
     * @throws Exception
     */
    public function put(string $method, array $params = []): array {
        return $this->call($method, $params, Methods::PUT);
    }

    /**
     * @param string $method
     * @param array $params
     * @return bool|mixed
     * @throws Exception
     */
    public function delete(string $method, array $params = []): array {
        return $this->call($method, $params, Methods::DELETE);
    }

    /**
     * @return int
     */
    public function get_last_http_code(): int {
        return $this->lastHttpCode;
    }

    /**
     * @param $httpMethod
     * @param array $params
     * @return array
     */
    private function get_options(string $httpMethod, array $params): array {
        if ($httpMethod === Methods::GET) {
            return ['query' => $params];
        }
        foreach ($params as $param) {
            if (is_resource($param)) {
                return ['multipart' => $this->convert_to_multipart($params)];
            }
        }
        return ['form_params' => $params];
    }

    /**
     * @param array $params
     * @return array
     */
    private function convert_to_multipart(array $params): array {
        $multipart = [];
        foreach ($params as $key => $value) {
            $multipart[] = [
                'name'     => $key,
                'contents' => $value,
            ];
        }
        return $multipart;
    }

    public function create_batch(bool $stopOnJobError = false, ?string $callBackUrl = null ):int{
        $batchApi = new Batch($this);
        return $batchApi->create($stopOnJobError, $callBackUrl);
    }

    public function commit_batch(int $batchId):bool{
        $batchApi = new Batch($this);
        return $batchApi->commit($batchId);
    }

    public function get_batch_results(int $batchId):array{
        $batchApi = new Batch($this);
        return $batchApi->get_results($batchId);
    }
}
