<?php

namespace App\Http\Enum;

/**
 * HttpMethods enum defines the common HTTP request methods.
 */
enum HttpMethods: string
{
    /**
     * @var string GET - The HTTP GET method is used to request data from a server.
     */
    case GET = 'GET';

    /**
     * @var string POST - The HTTP POST method is used to submit data to be processed to a server.
     */
    case POST = 'POST';
}
