<?php

namespace App\Middleware;

use App\Http\Request\Request;

abstract class AbstractMiddleware
{
    /**
     * @param Request $request
     * @param callable $next
     * @return void
     */
    public function handle(Request $request, callable $next): void
    {
        $next($request);
    }
}
