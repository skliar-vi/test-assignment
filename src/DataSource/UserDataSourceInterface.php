<?php

namespace App\DataSource;

/**
 * UserDataSourceInterface defines the methods required for a user data source.
 */
interface UserDataSourceInterface
{
    /**
     * Retrieves all users from the data source.
     *
     * @return array An array of all users.
     */
    public function getAll(): array;

    /**
     * Finds a user by specific criteria.
     *
     * @param array $criteria The criteria to search for the user.
     * @return array|null An array representing the user data if found, null otherwise.
     */
    public function findOne(array $criteria): ?array;
}
