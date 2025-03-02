<?php

namespace App\Exception;

/**
 * DataSourceException class represents an exception related to data source errors.
 */
class DataSourceException extends \Exception
{
    /**
     * The default error message for data source exceptions.
     */
    public const string DEFAULT_MESSAGE = 'Data source error';

    public function __construct(
        string     $message = null,
        int        $code = 0,
        \Throwable $previous = null
    )
    {
        parent::__construct($message ?? self::DEFAULT_MESSAGE, $code, $previous);
    }
}
