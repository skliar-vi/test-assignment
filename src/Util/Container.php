<?php

declare(strict_types=1);

namespace App\Util;

/**
 * Container class implements a simple dependency injection container.
 *
 * This class provides methods to bind and resolve dependencies, following the singleton pattern.
 */
class Container
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
     * Private constructor to prevent creating a new instance via the `new` operator.
     */
    private function __construct()
    {
    }

    /**
     * Binds a resolver callable to a name in the container.
     *
     * @param string $name The name of the binding.
     * @param callable $resolver The resolver callable.
     * @return void
     */
    public function bind(string $name, callable $resolver): void
    {
        $this->bindings[$name] = $resolver;
    }

    /**
     * Resolves a binding by name and returns the result of the resolver callable.
     *
     * @param string $name The name of the binding.
     * @return mixed The result of the resolver callable.
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
     *
     * @return Container The single instance of the container.
     */
    public static function getInstance(): Container
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
