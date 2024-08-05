<?php

namespace App\Http;

/**
 * AbstractRouter class provides a base implementation for a router with singleton pattern.
 */
abstract class AbstractRouter implements RouterInterface
{
    /**
     * The single instance of the router.
     */
    protected static ?RouterInterface $instance = null;

    /**
     * Final private constructor to prevent creating a new instance via the `new` operator.
     */
    final private function __construct()
    {
    }

    final public static function getInstance(): static
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function loadRoutes(string $path): void
    {
        include_once $path;
    }

    /**
     * Final protected clone method to prevent cloning of the instance.
     */
    final protected function __clone()
    {
    }

    /**
     *  Unserialize method to prevent unserializing of the instance throws the exception.
     *
     * @throws \Exception
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}
