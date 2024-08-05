<?php

namespace App\Denormalizer;

use App\Entity\User;
use App\Exception\DenormalizerException;

/**
 * UserDenormalizer class provides methods to denormalize user data.
 */
class UserDenormalizer implements DenormalizerInterface
{
    public function denormalizeOne(array $data): User
    {
        try {
            return new User(
                $data['id'],
                $data['email'],
                $data['name'],
                $data['password'],
                $data['age'] ?? null
            );
        } catch (\Exception $e) {
            throw new DenormalizerException();
        }
    }

    public function denormalizeMany(array $arrayOfArrays): array
    {
        $denormalizedArray = [];

        foreach ($arrayOfArrays as $data) {
            $denormalizedArray[] = $this->denormalizeOne($data);
        }

        return $denormalizedArray;
    }
}