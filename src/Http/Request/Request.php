<?php

declare(strict_types=1);

namespace App\Http\Request;

/**
 * Request class implements RequestInterface and represents an HTTP request.
 *
 * This class provides methods to retrieve information about the HTTP request, such as the method, URI, body, query parameters, and headers.
 */
class Request implements RequestInterface
{
    /**
     * Gets the HTTP method of the request.
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Gets the URI of the request.
     */
    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Gets the body of the request.
     *
     * @return array<string, string> An associative array of the request body parameters.
     */
    public function getBody(): array
    {
        return $_POST;
    }

    /**
     * Gets the query parameters of the request.
     *
     * @return array<string, string> An associative array of the query parameters.
     */
    public function getQueryParams(): array
    {
        return $_GET;
    }

    /**
     * Gets the headers of the request.
     *
     * @return array<string, string> An associative array of the request headers.
     */
    public function getHeaders(): array
    {
        return getallheaders();
    }
}
