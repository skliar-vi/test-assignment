<?php

namespace App\Strategies\Auth;

interface AuthStrategyInterface
{
    public function isLoggedIn(): bool;

    public function sendUnauthenticatedResponse(): void;
}
