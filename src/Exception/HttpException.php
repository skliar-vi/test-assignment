<?php

namespace App\Exception;

class HttpException extends \Exception
{
    public int $httpCode;

    public function __construct(
        string $message = '',
        int $code = 0,
        \Throwable $previous = null,
        $httpCode = 500,
    ) {
        parent::__construct($message, $code, $previous);
        $this->httpCode = $httpCode;
    }
}
