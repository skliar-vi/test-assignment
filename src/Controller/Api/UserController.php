<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Collection\UserCollection;
use App\Exception\HttpException;
use App\Http\Request\Request;
use App\Http\Response\JsonResponse;
use App\Normalizer\UserNormaliser;
use App\Repository\UserRepository;

/**
 * UserController class handles API requests related to User entities.
 */
class UserController
{
    /**
     * UserController constructor.
     */
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * Retrieves all users and returns them as a JSON response.
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
     * Finds a user by their ID and returns the user data as a JSON response.
     *
     * @throws HttpException If the user is not found.
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
