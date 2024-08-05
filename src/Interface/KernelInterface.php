<?php

namespace App\Interface;

/**
 * KernelInterface defines the methods required for the application kernel.
 */
interface KernelInterface
{
    /**
     * Boots the application.
     *
     * This method is responsible for setting up the application,
     * registering routes, and configuring middleware.
     */
    public function boot(): void;
}
