<?php

namespace App\Middleware;

use App\Http\Request\Request;

/**
 * AbstractMiddleware provides a base implementation for HTTP middleware.
 */
abstract class AbstractMiddleware
{
    /**
     * Handles an incoming request and passes it to the next middleware or final handler.
     */
    public function handle(Request $request, callable $next): void
    {
        $next($request);
    }
}
