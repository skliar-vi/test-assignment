<?php

namespace App\Exception;

class DataSourceException extends \Exception
{
    public const string DEFAULT_MESSAGE = 'Data source error';

    public function __construct(
        string     $message = null,
        int        $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct(isset($message) ?: self::DEFAULT_MESSAGE, $code, $previous);
    }
}
