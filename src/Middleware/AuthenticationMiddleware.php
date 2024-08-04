<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Http\Request\Request;
use App\Strategies\Auth\AuthStrategyInterface;

class AuthenticationMiddleware extends AbstractMiddleware
{
    private readonly AuthStrategyInterface $strategy;

    public function __construct(AuthStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param Request $request
     * @param callable $next
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
