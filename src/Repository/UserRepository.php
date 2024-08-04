<?php

declare(strict_types=1);

namespace App\Repository;

use App\DataSource\UserDataSourceInterface;
use App\Entity\User;

/**
 * UserRepository class handles the retrieval and deserialization of User entities from a data source.
 */
class UserRepository
{
    /**
     * UserRepository constructor.
     *
     * @param UserDataSourceInterface $dataSource The data source for user data.
     */
    public function __construct(protected readonly UserDataSourceInterface $dataSource)
    {
    }

    /**
     * Retrieves all users from the data source.
     *
     * @return User[] An array of User entities.
     */
    public function getAll(): array
    {
        return $this->deserialize($this->dataSource->getAll(), true);
    }

    /**
     * Finds a user by specific criteria from the data source.
     *
     * @param array $criteria The criteria to search for the user.
     * @return User|null The User entity if found, null otherwise.
     */
    public function findOne(array $criteria): ?User
    {
        if (!$rawData = $this->dataSource->findOne($criteria)) {
            return null;
        }

        return $this->deserialize($this->dataSource->findOne($criteria));
    }

    /**
     * Deserializes raw data into User entities.
     *
     * @param array $rawData The raw data to be deserialized.
     * @param bool $arrayOfArrays Indicates if the raw data represents an array of users.
     * @return User[]|User An array of User entities or a single User entity.
     */
    public function deserialize(array $rawData, bool $arrayOfArrays = false): array|User
    {
        if (!$arrayOfArrays) {
            return $this->constructUser($rawData);
        }

        $users = [];

        foreach ($rawData as $rawUser) {
            $users[] = $this->constructUser($rawUser);
        }

        return $users;
    }

    /**
     * Constructs a User entity from raw data.
     *
     * @param array $rawData The raw data to construct the User entity from.
     * @return User The constructed User entity.
     */
    public function constructUser(array $rawData): User
    {
        return new User(
            $rawData['id'],
            $rawData['email'],
            $rawData['name'],
            $rawData['password'],
            $rawData['age'] ?? null
        );
    }
}
