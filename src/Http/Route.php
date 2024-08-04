<?php

namespace App\Http;

use App\Http\Enum\HttpMethods;

/**
 * Route class represents an HTTP route with a method, URI, handler, and middlewares.
 */
class Route
{
    /**
     * @var HttpMethods The HTTP method of the route.
     */
    private HttpMethods $method;

    /**
     * @var string The URI of the route.
     */
    private string $uri;

    /**
     * @var array The handler for the route.
     */
    private array $handler;

    /**
     * @var MiddlewareInterface[] The middlewares for the route.
     */
    private array $middlewares;

    /**
     * Route constructor.
     *
     * @param HttpMethods $method The HTTP method of the route.
     * @param string $uri The URI of the route.
     * @param array $handler The handler for the route.
     * @param MiddlewareInterface[] $middlewares The middlewares for the route. Defaults to an empty array.
     */
    public function __construct(HttpMethods $method, string $uri, array $handler, array $middlewares = [])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    /**
     * Gets the HTTP method of the route.
     *
     * @return HttpMethods The HTTP method of the route.
     */
    public function getMethod(): HttpMethods
    {
        return $this->method;
    }

    /**
     * Gets the URI of the route.
     *
     * @return string The URI of the route.
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Gets the handler for the route.
     *
     * @return array The handler for the route.
     */
    public function getHandler(): array
    {
        return $this->handler;
    }

    /**
     * Gets the middlewares for the route.
     *
     * @return MiddlewareInterface[] The middlewares for the route.
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
