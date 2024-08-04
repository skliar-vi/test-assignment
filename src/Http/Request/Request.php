<?php

declare(strict_types=1);

namespace App\Http\Request;

class Request implements RequestInterface
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getBody(): array
    {
        return $_POST;
    }

    public function getQueryParams(): array
    {
        return $_GET;
    }

    public function getHeaders(): array
    {
        return getallheaders();
    }
}
