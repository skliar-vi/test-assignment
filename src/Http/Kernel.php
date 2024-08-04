<?php

declare(strict_types=1);

namespace App\Http;

use App\Config\ConfigProvider;
use App\Http\Request\Request;
use App\Interface\KernelInterface;
use App\Util\Container;

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
     *
     * @return void
     */
    public function boot(): void
    {
        $this->setUpErrorHandlers();
        $container = Container::getInstance();

        $this->setUpRouter($container)->dispatch(new Request());
    }

    /**
     * Sets up custom error and exception handlers.
     *
     * @return void
     */
    private function setUpErrorHandlers(): void
    {
        set_exception_handler([new ExceptionHandler(), 'handle']);
        set_error_handler([new ExceptionHandler(), 'handle']);
    }

    /**
     * Sets up the router with the configured routes path.
     *
     * @param $container
     * @return Router
     * @throws \RuntimeException
     */
    public function setUpRouter($container): Router
    {
        $router = Router::getInstance();
        $configProvider = $container->make(ConfigProvider::class);
        $routesPath = $configProvider->get('ROUTES_PATH');

        if (!$routesPath || !file_exists($routesPath)) {
            throw new \RuntimeException('Invalid routes path.');
        }

        $router->loadRoutes($routesPath);

        return $router;
    }
}
