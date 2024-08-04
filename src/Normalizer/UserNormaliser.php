<?php

namespace App\Normalizer;

use App\Entity\User;

class UserNormaliser
{
    /**
     * @param User $user
     * @return array
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
