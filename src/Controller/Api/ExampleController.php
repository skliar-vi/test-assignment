<?php

namespace App\Controller\Api;

use App\Http\Response\JsonResponse;

class ExampleController
{
    /**
     * @return JsonResponse
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