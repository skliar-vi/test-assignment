<?php

namespace App\Http\Enum;

/**
 * HttpDefaultMessages enum defines default HTTP response messages.
 */
enum HttpDefaultMessages: string
{
    /**
     * OK - The request has succeeded.
     */
    case OK = 'OK';

    /**
     * NOT_FOUND - The requested resource could not be found.
     */
    case NOT_FOUND = 'Not Found';

    /**
     * UNAUTHORIZED - The request requires user authentication.
     */
    case UNAUTHORIZED = 'Unauthorized';

    /**
     * FORBIDDEN - The server understood the request but refuses to authorize it.
     */
    case FORBIDDEN = 'Forbidden';

    /**
     * INTERNAL_SERVER_ERROR - The server encountered an internal error.
     */
    case INTERNAL_SERVER_ERROR = 'Internal Server Error';
}
