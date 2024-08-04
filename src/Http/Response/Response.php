<?php

namespace App\Http\Response;

use App\Http\Enum\HttpStatusCodes;
use InvalidArgumentException;

class Response
{
    private array $headers = [];
    private string $content = '';
    private int|HttpStatusCodes $statusCode = HttpStatusCodes::OK;

    public function __construct(string $content = '', int|HttpStatusCodes $statusCode = HttpStatusCodes::OK, array $headers = [])
    {
        $this->setContent($content);
        $this->setStatusCode($statusCode);
        $this->applyDefaultHeaders();

        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }
    }

    /**
     * @param string $name
     * @param string|null $value
     * @return $this
     */
    public function setHeader(string $name, string $value = null): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param int|HttpStatusCodes $statusCode
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setStatusCode(int|HttpStatusCodes $statusCode): self
    {
        if (is_int($statusCode) && !HttpStatusCodes::tryFrom($statusCode)) {
            throw new InvalidArgumentException('Invalid status code');
        }

        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return void
     */
    final public function sendHeaders(): void
    {
        foreach ($this->getHeaders() as $name => $value) {
            header("$name" . ($value ? ": $value" : ''));
        }
    }

    /**
     * @return void
     */
    final public function sendStatusCode(): void
    {
        $statusCode = $this->getStatusCode();

        http_response_code(is_int($statusCode) ? $statusCode : $statusCode->value);
    }

    /**
     * @return void
     */
    final public function sendContent(): void
    {
        echo $this->content;
    }

    /**
     * @return never
     */
    public function send(): never
    {
        $this->sendHeaders();
        $this->sendStatusCode();
        $this->sendContent();
        exit;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return int|HttpStatusCodes
     */
    public function getStatusCode(): int|HttpStatusCodes
    {
        return $this->statusCode;
    }

    /**
     * @return void
     */
    private function applyDefaultHeaders(): void
    {
        $this->setHeader('Cache-Control', 'no-cache');
        $this->setHeader('X-Request-ID', uniqid());
        $this->setHeader('Content-Type', 'plain/text');
    }
}
