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
     * @var array The headers of the response.
     */
    private array $headers = [];

    /**
     * @var string The content of the response.
     */
    private string $content = '';

    /**
     * @var int|HttpStatusCodes The status code of the response.
     */
    private int|HttpStatusCodes $statusCode = HttpStatusCodes::OK;

    /**
     * Response constructor.
     *
     * @param string $content The content of the response. Defaults to an empty string.
     * @param int|HttpStatusCodes $statusCode The status code of the response. Defaults to HttpStatusCodes::OK.
     * @param array $headers The headers of the response. Defaults to an empty array.
     */
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
     *
     * @param string $name The name of the header.
     * @param string|null $value The value of the header. Defaults to null.
     * @return $this
     */
    public function setHeader(string $name, string $value = null): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    /**
     * Sets the content of the response.
     *
     * @param string $content The content to set.
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Sets the status code of the response.
     *
     * @param int|HttpStatusCodes $statusCode The status code to set.
     * @return $this
     * @throws InvalidArgumentException If the status code is invalid.
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
     *
     * @return void
     */
    final public function sendHeaders(): void
    {
        foreach ($this->getHeaders() as $name => $value) {
            header("$name" . ($value ? ": $value" : ''));
        }
    }

    /**
     * Sends the status code of the response.
     *
     * @return void
     */
    final public function sendStatusCode(): void
    {
        $statusCode = $this->getStatusCode();

        http_response_code(is_int($statusCode) ? $statusCode : $statusCode->value);
    }

    /**
     * Sends the content of the response.
     *
     * @return void
     */
    final public function sendContent(): void
    {
        echo $this->content;
    }

    /**
     * Sends the response to the client.
     *
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
     * Gets the content of the response.
     *
     * @return string The content of the response.
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Gets the headers of the response.
     *
     * @return array The headers of the response.
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Gets the status code of the response.
     *
     * @return int|HttpStatusCodes The status code of the response.
     */
    public function getStatusCode(): int|HttpStatusCodes
    {
        return $this->statusCode;
    }

    /**
     * Applies default headers to the response.
     *
     * @return void
     */
    private function applyDefaultHeaders(): void
    {
        $this->setHeader('Cache-Control', 'no-cache');
        $this->setHeader('X-Request-ID', uniqid());
        $this->setHeader('Content-Type', 'plain/text');
    }
}
