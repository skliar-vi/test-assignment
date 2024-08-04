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

return $container;
