<?php

namespace App\Http\Response;

use App\Http\Enum\HttpStatusCodes;
use InvalidArgumentException;

/**
 * Response class represents an HTTP response.
 *
 * This class provides methods to set the content, status code, and headers of an HTTP response,
 * and to send the response to the client.
 */
class Response
{
    /**
     * The headers of the response.
     */
    private array $headers = [];

    /**
     * The content of the response.
     */
    private string $content = '';

    /**
     *  The status code of the response.
     */
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
     * Sets a header for the response.
     */
    public function setHeader(string $name, string $value = null): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Sets the content of the response.
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Sets the status code of the response.
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
     * Sends the headers of the response.
     */
    final public function sendHeaders(): void
    {
        foreach ($this->getHeaders() as $name => $value) {
            header("$name" . ($value ? ": $value" : ''));
        }
    }

    /**
     * Sends the status code of the response.
     */
    final public function sendStatusCode(): void
    {
        $statusCode = $this->getStatusCode();

        http_response_code(is_int($statusCode) ? $statusCode : $statusCode->value);
    }

    /**
     * Sends the content of the response.
     */
    final public function sendContent(): void
    {
        echo $this->content;
    }

    /**
     * Sends the response to the client.
     */
    public function send(): never
    {
        $this->sendHeaders();
        $this->sendStatusCode();
        $this->sendContent();
        exit;
    }

    /**
     * Gets the content of the response.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Gets the headers of the response.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Gets the status code of the response.
     */
    public function getStatusCode(): int|HttpStatusCodes
    {
        return $this->statusCode;
    }

    /**
     * Applies default headers to the response.
     */
    private function applyDefaultHeaders(): void
    {
        $this->setHeader('Cache-Control', 'no-cache');
        $this->setHeader('X-Request-ID', uniqid());
        $this->setHeader('Content-Type', 'plain/text');
        $this->setHeader('Connection', 'close');
        $this->setHeader('Date', gmdate('D, d M Y H:i:s T'));
        $this->setHeader('Server', 'PhpServer/1.0');
    }
}
