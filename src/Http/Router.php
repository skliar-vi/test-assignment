<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\Enum\HttpDefaultMessages;
use App\Http\Enum\HttpMethods;
use App\Http\Enum\HttpStatusCodes;
use App\Http\Request\RequestInterface;
use App\Http\Response\JsonResponse;
use App\Http\Response\Response;

/**
 * Router class handles the routing of HTTP requests to the appropriate handlers.
 *
 * This class extends AbstractRouter and provides methods to define and dispatch routes.
 */
class Router extends AbstractRouter
{
    /**
     * @var Route[] The list of registered routes.
     */
    private array $routes = [];

    public function loadRoutes(string $path): void
    {
        include_once $path;
    }

    /**
     * Registers a GET route.
     *
     * @param MiddlewareInterface[] $middlewares The middlewares for the route.
     */
    public function get(string $uri, callable $handler, array $middlewares = []): Route
    {
        return $this->addRoute(HttpMethods::GET, $uri, $handler, $middlewares);
    }

    public function addRoute(HttpMethods $method, string $uri, callable $handler, array $middlewares = []): Route
    {
        $route = new Route($method, $uri, $handler, $middlewares);
        $this->routes[] = $route;

        return $route;
    }

    public function dispatch(RequestInterface $request): void
    {
        $requestMethod = $request->getMethod();
        $requestUri = parse_url($request->getUri(), PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route->getMethod()->value === $requestMethod && preg_match($this->convertToRegex($route->getUri()), $requestUri, $matches)) {
                $parametersArray = array_merge([$request], array_slice($matches, 1));

                $this->handleMiddlewares($route->getMiddlewares(), $request, function () use ($route, $parametersArray) {
                    $response = $this->callHandler($route->getHandler(), $parametersArray);

                    if ($response instanceof Response) {
                        $response->send();
                    }
                });

                break;
            }
        }

        (new JsonResponse(
            ['error' => HttpDefaultMessages::NOT_FOUND],
            HttpStatusCodes::NOT_FOUND)
        )->send();
    }

    /**
     * Converts a route URI with parameters to a regex pattern.
     */
    private function convertToRegex(string $uri): string
    {
        return "#^" . preg_replace('#\{[^\}]+\}#', '([^/]+)', $uri) . "$#";
    }

    /**
     * Handles the middlewares for the route and proceeds to the final handler.
     *
     * @param MiddlewareInterface[] $middlewares The middlewares for the route.
     */
    private function handleMiddlewares(array $middlewares, RequestInterface $request, \Closure $finalHandler): void
    {
        $middlewareQueue = array_reverse($middlewares);

        $next = $finalHandler;
        foreach ($middlewareQueue as $middleware) {
            $next = function () use ($middleware, $request, $next) {
                $middleware->handle($request, $next);
            };
        }

        $next();
    }

    /**
     * Calls the route handler with prepared arguments
     */
    private function callHandler(callable $handler, array $parametersArray): mixed
    {
        return call_user_func_array($handler, $parametersArray);
    }
}
