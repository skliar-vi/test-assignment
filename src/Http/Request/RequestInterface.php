<?php

namespace App\Http\Request;

interface RequestInterface
{
    public function getMethod(): string;
    public function getUri(): string;
    public function getBody(): array;
    public function getQueryParams(): array;
    public function getHeaders(): array;
}
