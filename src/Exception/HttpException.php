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
     * @var int|HttpStatusCodes The HTTP status code associated with the exception.
     */
    public int|HttpStatusCodes $httpCode;

    /**
     * HttpException constructor.
     *
     * @param string $message The error message. Defaults to an empty string.
     * @param int $code The error code. Defaults to 0.
     * @param \Throwable|null $previous The previous throwable used for exception chaining. Defaults to null.
     * @param int|HttpStatusCodes $httpCode The HTTP status code. Defaults to HttpStatusCodes::INTERNAL_SERVER_ERROR.
     */
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
