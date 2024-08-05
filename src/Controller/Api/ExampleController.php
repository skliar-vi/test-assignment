<?php

namespace App\Controller\Api;

use App\Http\Response\JsonResponse;

/**
 * ExampleController class handles example API endpoints.
 */
class ExampleController
{
    /**
     * Handles the ping request and returns a pong response.
     */
    public function ping(): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => 'pong'
            ]
        );
    }
}