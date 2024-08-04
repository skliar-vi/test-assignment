<?php

namespace App\Http;

/**
 * AbstractRouter class provides a base implementation for a router with singleton pattern.
 */
abstract class AbstractRouter implements RouterInterface
{
    /**
     * The single instance of the router.
     *
     * @var RouterInterface|null
     */
    protected static ?RouterInterface $instance = null;

    /**
     * Private constructor to prevent creating a new instance via the `new` operator.
     */
    private function __construct()
    {
    }

    /**
     * Returns the single instance of the router.
     *
     * @return static The single instance of the router.
     */
    final public static function getInstance(): static
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * Loads routes from the specified path.
     *
     * @param string $path The path to the routes file.
     * @return void
     */
    public function loadRoutes(string $path): void
    {
        include_once $path;
    }

    /**
     * Private clone method to prevent cloning of the instance.
     */
    private function __clone()
    {
    }
}
