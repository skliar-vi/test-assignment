<?php

namespace App\Http;

use App\Http\Enum\HttpMethods;
use App\Http\Request\RequestInterface;

/**
 * RouterInterface defines the methods required for a router.
 *
 * This interface provides the blueprint for router classes that handle the registration and dispatching of routes.
 */
interface RouterInterface
{
    /**
     * Returns the single instance of the router.
     *
     * @return RouterInterface The single instance of the router.
     */
    public static function getInstance(): RouterInterface;

    /**
     * Registers a route with the specified method, URI, handler, and middlewares.
     *
     * @param HttpMethods $method The HTTP method of the route.
     * @param string $uri The URI of the route.
     * @param callable $handler The handler for the route.
     * @param array $middlewares The middlewares for the route. Defaults to an empty array.
     * @return Route The registered route.
     */
    public function addRoute(HttpMethods $method, string $uri, callable $handler, array $middlewares = []): Route;

    /**
     * Loads routes from the specified path.
     *
     * @param string $path The path to the routes file.
     * @return void
     */
    public function loadRoutes(string $path): void;

    /**
     * Dispatches the request to the appropriate route handler.
     *
     * @param RequestInterface $request The HTTP request instance.
     * @return void
     */
    public function dispatch(RequestInterface $request): void;
}
