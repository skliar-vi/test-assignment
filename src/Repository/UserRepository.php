<?php

declare(strict_types=1);

namespace App\Repository;

use App\DataSource\UserDataSourceInterface;
use App\Denormalizer\DenormalizerInterface;
use App\Entity\User;

/**
 * UserRepository class handles the retrieval and deserialization of User entities from a data source.
 */
class UserRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct(
        protected readonly UserDataSourceInterface $dataSource,
        protected readonly DenormalizerInterface $denormalizer,
    )
    {
    }

    /**
     * Retrieves all users from the data source.
     */
    public function getAll(): array
    {
        return $this->denormalizer->denormalizeMany($this->dataSource->getAll());
    }

    /**
     * Finds a user by specific criteria from the data source.
     */
    public function findOne(array $criteria): ?User
    {
        $rawData = $this->dataSource->findOne($criteria);

        if (!$rawData) {
            return null;
        }

        return $this->denormalizer->denormalizeOne($rawData);
    }
}
