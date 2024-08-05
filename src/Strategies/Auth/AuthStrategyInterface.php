<?php

namespace App\Strategies\Auth;

/**
 * AuthStrategyInterface defines the methods required for an authentication strategy.
 *
 * This interface provides the blueprint for classes that handle authentication logic.
 */
interface AuthStrategyInterface
{
    /**
     * Checks if the user is logged in.
     */
    public function isLoggedIn(): bool;
}
