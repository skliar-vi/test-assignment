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
     *
     * @param UserRepository $userRepository The repository instance to use for user data operations.
     */
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * Retrieves all users and returns them as a JSON response.
     *
     * @param Request $request The HTTP request instance.
     * @return JsonResponse A JSON response containing the list of all users.
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
     * @param Request $request The HTTP request instance.
     * @param int $id The ID of the user to find.
     * @return JsonResponse A JSON response containing the user data.
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
