<?php

namespace App\Repository;

use App\DataSource\UserDataSourceInterface;
use App\Entity\User;

class UserRepository
{
    public function __construct(protected UserDataSourceInterface $dataSource)
    {
    }

    /**
     * @return User[]
     */
    public function getAll(): array
    {
        return $this->deserialize($this->dataSource->getAll(), true);
    }

    /**
     * @param array $criteria
     * @return User|null
     */
    public function findOne(array $criteria): ?User
    {
        return $this->deserialize($this->dataSource->findOne($criteria));
    }

    /**
     * @param array $rawData
     * @param bool $arrayOfArrays
     * @return User[]|User
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
     * @param array $rawData
     * @return User
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
