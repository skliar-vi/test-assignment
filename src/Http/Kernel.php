<?php

declare(strict_types=1);

namespace App\Http;

use App\Config\ConfigProviderInterface;
use App\DI\Container;
use App\Http\Handler\ErrorHandler;
use App\Http\Handler\ExceptionHandler;
use App\Http\Request\Request;
use App\Interface\KernelInterface;

/**
 * Kernel class initializes the application and handles request dispatching.
 *
 * This class sets up the exception and error handlers, loads the routes, and dispatches the incoming request.
 */
class Kernel implements KernelInterface
{
    /**
     * Boots the application.
     *
     * This method sets the exception and error handlers, loads the routes, and dispatches the request.
     */
    public function boot(): void
    {
        $this->setUpErrorHandlers();
        $container = Container::getInstance();

        $this->setUpRouter($container)->dispatch(new Request());
    }

    /**
     * Sets up custom error and exception handlers.
     */
    private function setUpErrorHandlers(): void
    {
        set_exception_handler([new ExceptionHandler(), 'handle']);
        set_error_handler([new ErrorHandler(), 'handle']);
    }

    /**
     * Sets up the router with the configured routes path.
     *
     * @throws \RuntimeException
     */
    public function setUpRouter($container): Router
    {
        $router = Router::getInstance();
        $configProvider = $container->make(ConfigProviderInterface::class);
        $routesPath = $configProvider->get('ROUTES_PATH');

        if (!$routesPath || !file_exists($routesPath)) {
            throw new \RuntimeException('Invalid routes path.');
        }

        $router->loadRoutes($routesPath);

        return $router;
    }
}
