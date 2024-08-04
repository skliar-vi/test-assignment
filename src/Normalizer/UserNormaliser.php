<?php

namespace App\Normalizer;

use App\Entity\User;

/**
 * UserNormaliser class provides methods to normalize User entities into array representations.
 */
class UserNormaliser
{
    /**
     * Normalises a User entity into an array representation.
     *
     * @param User $user The User entity to be normalized.
     * @return array An array representation of the User entity.
     */
    public static function normalise(User $user): array
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'age' => $user->getAge(),
        ];
    }
}
