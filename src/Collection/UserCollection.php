<?php

namespace App\Collection;

use App\Entity\User;
use App\Normalizer\UserNormaliser;

/**
 * UserCollection class extends AbstractCollection to handle a collection of User entities.
 */
class UserCollection extends AbstractCollection
{
    /**
     * Converts the collection of User entities to an array of normalized data.
     */
    public function toArray(): array
    {
        return array_map(
            static fn(User $user): array => UserNormaliser::normalise($user),
            self::$items
        );
    }
}
