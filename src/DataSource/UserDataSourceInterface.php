<?php

namespace App\DataSource;

/**
 * UserDataSourceInterface defines the methods required for a user data source.
 */
interface UserDataSourceInterface
{
    /**
     * Retrieves all users from the data source.
     */
    public function getAll(): array;

    /**
     * Finds a user by specific criteria.
     */
    public function findOne(array $criteria): ?array;
}
