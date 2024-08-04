<?php

namespace App\Http;

use App\Http\Enum\HttpMethods;
use App\Http\Request\RequestInterface;

interface RouterInterface
{
    public static function getInstance(): RouterInterface;

    public function addRoute(HttpMethods $method, string $uri, $handler, array $middlewares = []): Route;

    public function loadRoutes($path): void;

    public function dispatch(RequestInterface $request): void;
}
