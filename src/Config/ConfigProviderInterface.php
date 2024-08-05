<?php

namespace App\Config;

interface ConfigProviderInterface
{
    /**
     * Retrieves a configuration value by key.
     */
    public function get(string $key, mixed $default = null): mixed;
}