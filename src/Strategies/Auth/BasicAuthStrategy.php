<?php

declare(strict_types=1);

namespace App\Strategies\Auth;

use App\Http\Enum\HttpStatusCodes;
use App\Http\Response\JsonResponse;
use App\Repository\UserRepository;

/**
 * BasicAuthStrategy handles basic authentication logic.
 *
 * This class implements the AuthStrategyInterface to provide methods for checking if a user is logged in
 * and sending an unauthenticated response.
 */
class BasicAuthStrategy implements AuthStrategyInterface
{
    /**
     * BasicAuthStrategy constructor.
     *
     * @param UserRepository $userRepository The user repository instance.
     */
    public function __construct(protected readonly UserRepository $userRepository)
    {
    }

    /**
     * Checks if the user is logged in using basic authentication.
     *
     * @return bool True if the user is logged in, false otherwise.
     */
    public function isLoggedIn(): bool
    {
        $authenticatedEmail = $_SERVER['PHP_AUTH_USER'] ?? null;
        $authenticatedPassword = $_SERVER['PHP_AUTH_PW'] ?? null;

        if (!isset($authenticatedEmail) || !isset($authenticatedPassword)) {
            return false;
        }

        $user = $this->userRepository->findOne(['email' => $authenticatedEmail]);

        if (!$user || !password_verify($authenticatedPassword, $user->getPassword())) {
            return false;
        }

        return true;
    }

    /**
     * Sends a response indicating the user is unauthenticated.
     *
     * This method sends a JSON response with a 401 Unauthorized status code and a WWW-Authenticate header.
     *
     * @return void
     */
    public function sendUnauthenticatedResponse(): void
    {
        (new JsonResponse(
            ['error' => 'Unauthorized'],
            HttpStatusCodes::UNAUTHORIZED,
            ['WWW-Authenticate' => 'Basic realm="Restricted Area"']
        ))->send();
    }
}
