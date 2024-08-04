<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Http\Request\Request;
use App\Strategies\Auth\AuthStrategyInterface;

/**
 * AuthenticationMiddleware handles the authentication of incoming HTTP requests.
 *
 * This middleware uses an authentication strategy to check if a user is logged in and sends an unauthenticated response if not.
 */
class AuthenticationMiddleware extends AbstractMiddleware
{
    /**
     * @var AuthStrategyInterface The authentication strategy instance.
     */
    private readonly AuthStrategyInterface $strategy;

    /**
     * AuthenticationMiddleware constructor.
     *
     * @param AuthStrategyInterface $strategy The authentication strategy instance.
     */
    public function __construct(AuthStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * Handles an incoming request and passes it to the next middleware or final handler.
     *
     * This method checks if the user is logged in using the authentication strategy and sends an unauthenticated response if not.
     *
     * @param Request $request The HTTP request instance.
     * @param callable $next The next middleware or final handler to be called.
     * @return void
     */
    public function handle(Request $request, callable $next): void
    {
        if (!$this->strategy->isLoggedIn()) {
            $this->strategy->sendUnauthenticatedResponse();
        }

        parent::handle($request, $next);
    }
}
