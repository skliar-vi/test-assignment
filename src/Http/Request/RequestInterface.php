<?php

namespace App\Http\Request;

/**
 * RequestInterface defines the methods required for handling an HTTP request.
 *
 * This interface provides the blueprint for classes that manage the retrieval of various parts of an HTTP request.
 */
interface RequestInterface
{
    /**
     * Gets the HTTP method of the request.
     *
     * @return string The HTTP method of the request (e.g., GET, POST).
     */
    public function getMethod(): string;

    /**
     * Gets the URI of the request.
     *
     * @return string The URI of the request.
     */
    public function getUri(): string;

    /**
     * Gets the body of the request.
     *
     * @return array<string, string> An associative array of the request body parameters.
     */
    public function getBody(): array;

    /**
     * Gets the query parameters of the request.
     *
     * @return array<string, string> An associative array of the query parameters.
     */
    public function getQueryParams(): array;

    /**
     * Gets the headers of the request.
     *
     * @return array<string, string> An associative array of the request headers.
     */
    public function getHeaders(): array;
}
