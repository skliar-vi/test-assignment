<?php

declare(strict_types=1);

namespace App\Strategies\Auth;

use App\Http\Enum\HttpStatusCodes;
use App\Http\Response\JsonResponse;
use App\Repository\UserRepository;

class BasicAuthStrategy implements AuthStrategyInterface
{
    public function __construct(protected readonly UserRepository $userRepository)
    {
    }

    /**
     * @return bool
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
