<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Config\ConfigProvider;
use App\Config\ConfigProviderInterface;
use App\Controller\Api\ExampleController;
use App\Controller\Api\UserController;
use App\DataSource\UserDataSourceInterface;
use App\DataSource\UserJsonDataSource;
use App\Denormalizer\UserDenormalizer;
use App\Middleware\AuthenticationMiddleware;
use App\Repository\UserRepository;
use App\Strategies\Auth\AuthStrategyInterface;
use App\Strategies\Auth\BasicAuthStrategy;
use App\DI\Container;

/**
 * Main script to bind dependencies to the container.
 *
 * This script initializes the Container instance and binds various services and dependencies to it.
 */

$container = Container::getInstance();

$container->bind(ConfigProviderInterface::class, function () {
    return new ConfigProvider([
        'USER_DATA_SOURCE_PATH' => realpath(__DIR__ . '/../data/users.json'),
        'DEBUG' => false,
        'ROUTES_PATH' => realpath(__DIR__ . '/Http/routes/api.php'),
    ],
    realpath(__DIR__ . '/../.env')
    );
});
$container->bind(UserDataSourceInterface::class, function ($container) {
    return new UserJsonDataSource(
        ($container->make(ConfigProviderInterface::class))->get('USER_DATA_SOURCE_PATH')
    );
});
$container->bind(UserRepository::class, function ($container) {
    return new UserRepository($container->make(UserDataSourceInterface::class), new UserDenormalizer());
});
$container->bind(UserController::class, function ($container) {
    return new UserController($container->make(UserRepository::class));
});
$container->bind(AuthStrategyInterface::class, function ($container) {
    return new BasicAuthStrategy($container->make(UserRepository::class));
});
$container->bind(AuthenticationMiddleware::class, function ($container) {
    return new AuthenticationMiddleware($container->make(AuthStrategyInterface::class));
});
$container->bind(ExampleController::class, function ($container) {
    return new ExampleController();
});

return $container;
