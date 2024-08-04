<?php

namespace App\DataSource;

interface UserDataSourceInterface
{
    public function getAll(): array;

    public function findOne(array $criteria): ?array;
}
