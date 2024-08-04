<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\Enum\HttpMethods;
use App\Http\Enum\HttpStatusCodes;
use App\Http\Request\RequestInterface;
use App\Http\Response\JsonResponse;
use App\Http\Response\Response;

class Router extends AbstractRouter
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    /**
     * @param string $path
     * @return void
     */
    public function loadRoutes($path): void
    {
        include_once $path;
    }

    /**
     * @param string $uri
     * @param $handler
     * @param array $middlewares
     * @return Route
     */
    public function get(string $uri, $handler, array $middlewares = []): Route
    {
        return $this->addRoute(HttpMethods::GET, $uri, $handler, $middlewares);
    }

    /**
     *  @param HttpMethods $method
      * @param string $uri
      * @param $handler
      * @param array $middlewares
      * @return Route
      */
    public function addRoute(HttpMethods $method, string $uri, $handler, array $middlewares = []): Route
    {
        $route = new Route($method, $uri, $handler, $middlewares);
        $this->routes[] = $route;

        return $route;
    }

    /**
     * @param RequestInterface $request
     * @return void
     */
    public function dispatch(RequestInterface $request): void
    {
        $requestMethod = $request->getMethod();
        $requestUri = parse_url($request->getUri(), PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route->getMethod()->value === $requestMethod && preg_match($this->convertToRegex($route->getUri()), $requestUri, $matches)) {
                $this->handleMiddlewares($route->getMiddlewares(), $request, function () use ($route, $matches, $request) {
                    $response = $this->callHandler($route->getHandler(), $matches, $request);

                    if ($response instanceof Response) {
                        $response->send();
                    }
                });
                return;
            }
        }

        (new JsonResponse(['error' => 'Not found'], HttpStatusCodes::NOT_FOUND))->send();
    }

    /**
     * @param string $uri
     * @return string
     */
    private function convertToRegex(string $uri): string
    {
        return "#^" . preg_replace('#\{[^\}]+\}#', '([^/]+)', $uri) . "$#";
    }

    /**
     * @param array $middlewares
     * @param RequestInterface $request
     * @param \Closure $finalHandler
     * @return void
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
     * @param $handler
     * @param array $matches
     * @param RequestInterface $request
     * @return mixed
     */
    private function callHandler($handler, array $matches, RequestInterface $request): mixed
    {
        return call_user_func_array($handler, array_merge([$request], array_slice($matches, 1)));
    }
}
