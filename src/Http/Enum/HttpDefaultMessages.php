<?php

namespace App\Http\Enum;

/**
 * HttpDefaultMessages enum defines default HTTP response messages.
 */
enum HttpDefaultMessages: string
{
    /**
     * @var string OK - The request has succeeded.
     */
    case OK = 'OK';

    /**
     * @var string NOT_FOUND - The requested resource could not be found.
     */
    case NOT_FOUND = 'Not Found';

    /**
     * @var string UNAUTHORIZED - The request requires user authentication.
     */
    case UNAUTHORIZED = 'Unauthorized';

    /**
     * @var string FORBIDDEN - The server understood the request but refuses to authorize it.
     */
    case FORBIDDEN = 'Forbidden';

    /**
     * @var string INTERNAL_SERVER_ERROR - The server encountered an internal error.
     */
    case INTERNAL_SERVER_ERROR = 'Internal Server Error';
}
