<?php

namespace App\Denormalizer;

use App\Entity\EntityInterface;
use App\Exception\DenormalizerException;

/**
 * DenormalizerInterface provides methods to denormalize data into entities.
 */
interface DenormalizerInterface
{
    /**
     * Denormalizes an array of data into an entity.
     * @throws DenormalizerException
     */
    public function denormalizeOne(array $data): EntityInterface;

    /**
     * Denormalizes an array of arrays into an array of entities.
     *
     * @return EntityInterface[]
     * @throws DenormalizerException
     *
     */
    public function denormalizeMany(array $arrayOfArrays): array;
}