<?php

declare(strict_types=1);

namespace App\Exception;

use App\Http\Enum\HttpStatusCodes;

/**
 * HttpException class represents an exception with an associated HTTP status code.
 *
 * This class extends the base Exception class and includes an HTTP status code to be used in HTTP responses.
 */
class HttpException extends \Exception
{
    /**
     * The HTTP status code associated with the exception.
     */
    public int|HttpStatusCodes $httpCode;

    public function __construct(
        string              $message = '',
        int                 $code = 0,
        \Throwable          $previous = null,
        int|HttpStatusCodes $httpCode = HttpStatusCodes::INTERNAL_SERVER_ERROR
    )
    {
        parent::__construct($message, $code, $previous);
        $this->httpCode = $httpCode;
    }
}
