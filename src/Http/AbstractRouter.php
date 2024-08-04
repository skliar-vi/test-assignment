<?php

namespace App\Http;

abstract class AbstractRouter implements RouterInterface
{
    /**
     * Instance
     *
     * @var RouterInterface
     */
    protected static $instance;

    private function __construct()
    {
    }

    final public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public function loadRoutes($path): void
    {
        include_once $path;
    }

    private function __clone()
    {
    }
}
