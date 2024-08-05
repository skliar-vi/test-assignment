<?php

namespace App\Http\Handler;

use App\Config\ConfigProviderInterface;
use App\DI\Container;
use App\Http\Enum\HttpDefaultMessages;
use App\Http\Enum\HttpStatusCodes;
use App\Http\Response\JsonResponse;

/**
 * ErrorHandler class handles PHP errors and provides appropriate responses.
 *
 * This class provides methods to handle errors and determine if debug mode is enabled.
 */
class ErrorHandler
{
    /*
     * Handles a PHP error.
     */
    public function handle(int $errno, string $errstr, string $errfile, int $errline)
    {
        if ($this->isDebugModeEnabled()) {
            echo "An error occurred: {$errstr} in {$errfile} on line {$errline}\n";
            return;
        }

        (new JsonResponse(
            HttpDefaultMessages::INTERNAL_SERVER_ERROR,
            HttpStatusCodes::INTERNAL_SERVER_ERROR
        ))->send();
    }

    /**
     * Determines if debug mode is enabled.
     */
    private function isDebugModeEnabled(): bool
    {
        $container = Container::getInstance();

        try {
            return (bool)($container->make(ConfigProviderInterface::class))->get('DEBUG');
        } catch (\Exception $e) {
            return false;
        }
    }
}