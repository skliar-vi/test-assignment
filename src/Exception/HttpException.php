<?php

namespace App\Exception;

use App\Http\Enum\HttpStatusCodes;

class HttpException extends \Exception
{
    public int $httpCode;

    public function __construct(
        string $message = '',
        int $code = 0,
        \Throwable $previous = null,
        $httpCode = HttpStatusCodes::INTERNAL_SERVER_ERROR,
    ) {
        parent::__construct($message, $code, $previous);
        $this->httpCode = $httpCode;
    }
}
