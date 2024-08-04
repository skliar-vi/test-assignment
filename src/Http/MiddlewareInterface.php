<?php

namespace App\Http;

use App\Http\Request\Request;

/**
 * MiddlewareInterface defines the methods required for HTTP middleware.
 */
interface MiddlewareInterface
{
    /**
     * Handles an incoming request and passes it to the next middleware or final handler.
     *
     * @param Request $request The HTTP request instance.
     * @param callable $next The next middleware or final handler to be called.
     * @return void
     */
    public function handle(Request $request, callable $next): void;
}
