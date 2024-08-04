<?php

namespace App\Http;

use App\Http\Request\Request;

interface MiddlewareInterface
{
    public function handle(Request $request, $next): void;
}
