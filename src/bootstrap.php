<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Config\ConfigProvider;
use App\Controller\Api\Auth\UserController;
use App\DataSource\UserJsonDataSource;
use App\Middleware\AuthenticationMiddleware;
use App\Repository\UserRepository;
use App\Strategies\Auth\BasicAuthStrategy;
use App\Util\Container;

$container = Container::getInstance();

$container->bind(ConfigProvider::class, function () {
    return new ConfigProvider([
        'USER_DATA_SOURCE_PATH' => realpath(__DIR__ . '/../data/users.json'),
        'DEBUG' => false,
    ]);
});
$container->bind(UserJsonDataSource::class, function ($container) {
    return new UserJsonDataSource(
        ($container->make(ConfigProvider::class))->get('USER_DATA_SOURCE_PATH')
    );
});
$container->bind(UserRepository::class, function ($container) {
    return new UserRepository($container->make(UserJsonDataSource::class));
});
$container->bind(UserController::class, function ($container) {
    return new UserController($container->make(UserRepository::class));
});
$container->bind(BasicAuthStrategy::class, function ($container) {
    return new BasicAuthStrategy($container->make(UserRepository::class));
});
$container->bind(AuthenticationMiddleware::class, function ($container) {
    return new AuthenticationMiddleware($container->make(BasicAuthStrategy::class));
});

return $container;
