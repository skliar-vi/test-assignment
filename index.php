<?php

use App\Http\Kernel;

require __DIR__ . '/src/bootstrap.php';

/**
 * Main script to initialize and boot the application.
 *
 * This script sets up error reporting, initializes the application kernels, and boots them.
 */

error_reporting(E_ERROR | E_PARSE);

$kernels = [
    'http' => new Kernel(),
];

foreach ($kernels as $kernel) {
    $kernel->boot();
}
