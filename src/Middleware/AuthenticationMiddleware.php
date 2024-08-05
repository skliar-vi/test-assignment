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
    public function __construct(private readonly AuthStrategyInterface $strategy)
    {
    }

    /**
     * Handles an incoming request and passes it to the next middleware or final handler.
     *
     * This method checks if the user is logged in using the authentication strategy.
     */
    public function handle(Request $request, callable $next): void
    {
        if (!$this->strategy->isLoggedIn()) {
            return;
        }

        parent::handle($request, $next);
    }
}
