<?php

namespace App\Http\Enum;

enum HttpDefaultMessages: string
{
    case OK = 'OK';
    case NOT_FOUND = 'Not Found';
    case UNAUTHORIZED = 'Unauthorized';
    case FORBIDDEN = 'Forbidden';
    case INTERNAL_SERVER_ERROR = 'Internal Server Error';
}
