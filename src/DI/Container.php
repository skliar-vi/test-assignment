<?php

declare(strict_types=1);

namespace App\DI;

/**
 * Container class implements a simple dependency injection container.
 *
 * This class provides methods to bind and resolve dependencies, following the singleton pattern.
 */
final class Container
{
    /**
     * The single instance of the container.
     *
     * @var Container|null
     */
    public static ?Container $instance = null;

    /**
     * The array of bindings, where each binding is a resolver callable.
     *
     * @var array
     */
    private array $bindings = [];

    /**
     * Private constructor to prevent creating a new instance of the container.
     */
    final private function __construct()
    {
    }

    /**
     * Binds a resolver callable to a name in the container.
     */
    public function bind(string $name, callable $resolver): void
    {
        $this->bindings[$name] = $resolver;
    }

    /**
     * Resolves a binding by name and returns the result of the resolver callable.
     *
     * @throws \Exception If the binding is not found.
     */
    public function make(string $name): mixed
    {
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]($this);
        }

        throw new \Exception("Service {$name} not found.");
    }

    /**
     * Returns the single instance of the container.
     */
    public static function getInstance(): Container
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Prevents cloning the instance of the container.
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
