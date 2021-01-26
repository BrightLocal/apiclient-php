<?php
namespace BrightLocal;

class ApiResponse {

    protected int $statusCode = 0;
    protected array $result = [];

    public function __construct(int $statusCode, array $result) {
        $this->statusCode = $statusCode;
        $this->result = $result;
    }

    public function getResult(): array {
        return $this->result;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function isSuccess(): bool {
        if (isset($this->result['success'])) {
            return $this->result['success'];
        }
        return in_array($this->statusCode, [200, 201], true);
    }
}
