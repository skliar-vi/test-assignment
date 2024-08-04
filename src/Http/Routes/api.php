<?php

declare(strict_types=1);

use App\Controller\Api\Auth\UserController;
use App\Http\Router;
use App\Middleware\AuthenticationMiddleware;
use App\Util\Container;

$container = Container::getInstance();

$userController = $container->make(UserController::class);

$router = Router::getInstance();

$router->get('/api/users', [$userController, 'getAll']);
$router->get('/api/users/{id}', [$userController, 'find']);
