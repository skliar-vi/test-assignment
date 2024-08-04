<?php

declare(strict_types=1);

namespace App\Util;

class Container
{
    public static Container|null $instance = null;
    private array $bindings = [];

    private function __construct()
    {
    }

    /**
     * @param string $name
     * @param callable $resolver
     * @return void
     */
    public function bind(string $name, callable $resolver): void
    {
        $this->bindings[$name] = $resolver;
    }

    /**
     * @param string $name
     * @throws \Exception
     * @return mixed
     */
    public function make(string $name): mixed
    {
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]($this);
        }

        throw new \Exception("Service {$name} not found.");
    }

    /**
     * @return Container
     */
    public static function getInstance(): Container
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
