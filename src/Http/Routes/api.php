<?php

declare(strict_types=1);

use App\Controller\Api\Auth\UserController;
use App\Http\Router;
use App\Middleware\AuthenticationMiddleware;
use App\Util\Container;

$container = Container::getInstance();

$userController = $container->make(UserController::class);
$authMiddleware = $container->make(AuthenticationMiddleware::class);

$router = Router::getInstance();

$router->get('/api/users', [$userController, 'getAll'], [$authMiddleware]);
$router->get('/api/users/{id}', [$userController, 'find'], [$authMiddleware]);
