<?php

namespace App\Http;

use App\Http\Enum\HttpMethods;

/**
 * Route class represents an HTTP route with a method, URI, handler, and middlewares.
 */
class Route
{
    /**
     * The HTTP method of the route.
     */
    private HttpMethods $method;

    /**
     * The URI of the route.
     */
    private string $uri;

    /**
     * The handler for the route.
     */
    private array $handler;

    /**
     * @var MiddlewareInterface[] The middlewares for the route.
     */
    private array $middlewares;

    /**
     * Route constructor.
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
     */
    public function getMethod(): HttpMethods
    {
        return $this->method;
    }

    /**
     * Gets the URI of the route.
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Gets the handler for the route.
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
