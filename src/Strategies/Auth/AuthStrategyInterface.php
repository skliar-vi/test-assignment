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
     *
     * @return bool True if the user is logged in, false otherwise.
     */
    public function isLoggedIn(): bool;

    /**
     * Sends a response indicating the user is unauthenticated.
     *
     * This method is called when an unauthenticated access attempt is detected.
     *
     * @return void
     */
    public function sendUnauthenticatedResponse(): void;
}
