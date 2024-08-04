<?php

declare(strict_types=1);

namespace App\Http;

use App\Config\ConfigProvider;
use App\Exception\HttpException;
use App\Http\Enum\HttpDefaultMessages;
use App\Http\Enum\HttpStatusCodes;
use App\Http\Response\JsonResponse;
use App\Util\Container;

/**
 * ExceptionHandler class handles exceptions and provides an appropriate JSON response.
 */
class ExceptionHandler
{
    /**
     * Handles the given exception and sends a JSON response.
     *
     * @param \Throwable $e The exception to handle.
     * @return never
     */
    public function handle(\Throwable $e): never
    {
        $isDebugMode = $this->isDebugModeEnabled();

        $errorResponse = [
            'error' => $e instanceof HttpException || $isDebugMode
                ? $e->getMessage()
                : HttpDefaultMessages::INTERNAL_SERVER_ERROR,
        ];

        if ($isDebugMode) {
            $errorResponse['trace'] = $e->getTrace();
        }

        $statusCode = $e instanceof HttpException
            ? $e->httpCode
            : HttpStatusCodes::INTERNAL_SERVER_ERROR;

        $response = new JsonResponse($errorResponse, $statusCode);
        $response->send();
    }

    /**
     * Determines if debug mode is enabled.
     *
     * @return bool True if debug mode is enabled, false otherwise.
     */
    private function isDebugModeEnabled(): bool
    {
        $container = Container::getInstance();

        try {
            return (bool)($container->make(ConfigProvider::class))->get('DEBUG');
        } catch (\Exception $e) {
            return false;
        }
    }
}
