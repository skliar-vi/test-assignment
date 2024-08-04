<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Collection\UserCollection;
use App\Exception\HttpException;
use App\Http\Request\Request;
use App\Http\Response\JsonResponse;
use App\Normalizer\UserNormaliser;
use App\Repository\UserRepository;

class UserController
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        return new JsonResponse(
            (new UserCollection(
                $this->userRepository->getAll()
            ))->toArray()
        );
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws HttpException
     */
    public function find(Request $request, int $id): JsonResponse
    {
        $user = $this->userRepository->findOne(['id' => $id]);

        if (!$user) {
            throw new HttpException('User not found', httpCode: 404);
        }

        return new JsonResponse(UserNormaliser::normalise($user));
    }
}
