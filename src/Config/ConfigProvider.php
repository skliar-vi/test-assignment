<?php

declare(strict_types=1);

namespace App\Config;

/**
 * ConfigProvider class provides configuration settings for the application.
 */
final class ConfigProvider implements ConfigProviderInterface
{
    private array $config;

    public function __construct(array $defaultConfig = [], string $envFilePath = null)
    {
        $this->config = $defaultConfig;
        $this->loadEnvConfig($envFilePath);
    }

    /**
     * Loads environment-specific configuration from a file.
     */
    private function loadEnvConfig(?string $envFilePath): void
    {
        if (is_string($envFilePath) && file_exists($envFilePath)) {
            $envConfig = parse_ini_file($envFilePath);

            $this->config = array_merge(
                array_filter($envConfig, fn($key) => $envConfig[$key], ARRAY_FILTER_USE_KEY),
                $envConfig);
        }
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->config[$key] ?? $default;
    }
}
