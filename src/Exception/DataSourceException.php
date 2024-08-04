<?php

namespace App\Exception;

/**
 * DataSourceException class represents an exception related to data source errors.
 *
 * This class extends the base Exception class and provides a default message for data source errors.
 */
class DataSourceException extends \Exception
{
    /**
     * The default error message for data source exceptions.
     */
    public const string DEFAULT_MESSAGE = 'Data source error';

    /**
     * DataSourceException constructor.
     *
     * @param string|null $message The error message. Defaults to a predefined message if not provided.
     * @param int $code The error code. Defaults to 0.
     * @param \Throwable|null $previous The previous throwable used for exception chaining. Defaults to null.
     */
    public function __construct(
        string     $message = null,
        int        $code = 0,
        \Throwable $previous = null
    )
    {
        parent::__construct($message ?? self::DEFAULT_MESSAGE, $code, $previous);
    }
}
