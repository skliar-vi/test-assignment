<?php

namespace App\Exception;

/**
 * DenormalizerException class represents an exception related to denormalization errors.
 */
class DenormalizerException extends \Exception
{
    /**
     * The default error message for denormalizer exceptions.
     */
    public const string DEFAULT_MESSAGE = 'Denormalizer error';

    public function __construct(
        string     $message = null,
        int        $code = 0,
        \Throwable $previous = null
    )
    {
        parent::__construct($message ?? self::DEFAULT_MESSAGE, $code, $previous);
    }
}
