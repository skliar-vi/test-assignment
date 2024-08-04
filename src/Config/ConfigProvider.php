<?php

declare(strict_types=1);

namespace App\Config;

class ConfigProvider
{
    private array $config;

    public function __construct(array $defaultConfig = [])
    {
        $this->config = $defaultConfig;
        $this->loadEnvConfig();
    }

    /**
     * @return void
     */
    private function loadEnvConfig(): void
    {
        $envFile = __DIR__ . '/../../.env';

        if (file_exists($envFile)) {
            $envConfig = parse_ini_file($envFile);
            $this->config = array_merge($this->config, $envConfig);
        }
    }

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->config[$key] ?? $default;
    }
}
