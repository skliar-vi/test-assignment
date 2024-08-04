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

    private function loadEnvConfig(): void
    {
        $envFile = __DIR__ . '/../../.env';

        if (file_exists($envFile)) {
            $envConfig = parse_ini_file($envFile);
            $this->config = array_merge($this->config, $envConfig);
        }
    }

    public function get(string $key, $default = null)
    {
        return $this->config[$key] ?? $default;
    }
}
