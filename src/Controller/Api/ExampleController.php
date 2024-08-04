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
     *
     * @return JsonResponse A JSON response with a message indicating 'pong'.
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