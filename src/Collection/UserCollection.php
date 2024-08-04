<?php

namespace App\Collection;

use App\Entity\User;
use App\Normalizer\UserNormaliser;

class UserCollection extends AbstractCollection
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(
            fn (User $user) => UserNormaliser::normalise($user),
            self::$items
        );
    }
}
