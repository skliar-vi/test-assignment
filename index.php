<?php

use App\Http\Kernel;
require __DIR__ . '/src/bootstrap.php';

error_reporting(E_ERROR | E_PARSE);

$kernels = [
    'http' => new Kernel(),
];

foreach ($kernels as $kernel) {
    $kernel->boot();;
}