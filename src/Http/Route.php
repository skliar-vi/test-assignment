<?php

namespace App\Http;

use App\Http\Enum\HttpMethods;

class Route
{
    private HttpMethods $method;
    private string $uri;
    private array $handler;

    /**
     * @var MiddlewareInterface[]
     */
    private array $middlewares;

    public function __construct(HttpMethods $method, string $uri, array $handler, array $middlewares = [])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    public function getMethod(): HttpMethods
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHandler(): array
    {
        return $this->handler;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
