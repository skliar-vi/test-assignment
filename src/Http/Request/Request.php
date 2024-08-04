<?php

declare(strict_types=1);

namespace App\Http\Request;

class Request implements RequestInterface
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return array<string, string>
     */
    public function getBody(): array
    {
        return $_POST;
    }

    /**
     * @return array<string, string>
     */
    public function getQueryParams(): array
    {
        return $_GET;
    }

    /**
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return getallheaders();
    }
}
