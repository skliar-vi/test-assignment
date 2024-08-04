<?php

namespace App\Http\Enum;

/**
 * HttpStatusCodes enum defines standard HTTP status codes.
 */
enum HttpStatusCodes: int
{
    /**
     * @var int OK - The request has succeeded.
     */
    case OK = 200;

    /**
     * @var int CREATED - The request has been fulfilled and resulted in a new resource being created.
     */
    case CREATED = 201;

    /**
     * @var int NO_CONTENT - The server successfully processed the request and is not returning any content.
     */
    case NO_CONTENT = 204;

    /**
     * @var int BAD_REQUEST - The server cannot or will not process the request due to a client error.
     */
    case BAD_REQUEST = 400;

    /**
     * @var int UNAUTHORIZED - The request requires user authentication.
     */
    case UNAUTHORIZED = 401;

    /**
     * @var int FORBIDDEN - The server understood the request but refuses to authorize it.
     */
    case FORBIDDEN = 403;

    /**
     * @var int NOT_FOUND - The requested resource could not be found.
     */
    case NOT_FOUND = 404;

    /**
     * @var int METHOD_NOT_ALLOWED - The request method is not supported for the requested resource.
     */
    case METHOD_NOT_ALLOWED = 405;

    /**
     * @var int CONFLICT - The request could not be completed due to a conflict with the current state of the target resource.
     */
    case CONFLICT = 409;

    /**
     * @var int INTERNAL_SERVER_ERROR - The server encountered an internal error and was unable to complete the request.
     */
    case INTERNAL_SERVER_ERROR = 500;
}
