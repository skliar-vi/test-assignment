<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\Request\Request;
use App\Interface\KernelInterface;

class Kernel implements KernelInterface
{
    public function boot(): void
    {
        set_exception_handler([new ExceptionHandler(), 'handle']);
        set_error_handler([new ExceptionHandler(), 'handle']);

        $router = Router::getInstance();

        $router->loadRoutes(__DIR__ . '/Routes/api.php');
        $router->dispatch(new Request());
    }
}
