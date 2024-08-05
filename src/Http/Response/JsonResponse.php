<?php

declare(strict_types=1);

namespace App\Http\Response;

use App\Http\Enum\HttpStatusCodes;

/**
 * JsonResponse class represents an HTTP response with JSON content.
 */
class JsonResponse extends Response
{
    /**
     * The JSON data to be included in the response.
     */
    private mixed $json = null;

    public function __construct(mixed $json = null, int|HttpStatusCodes $statusCode = HttpStatusCodes::OK, array $headers = [])
    {
        parent::__construct('', $statusCode, $headers);

        $this->setHeader('Content-Type', 'application/json');
        $this->setJson($json);
    }

    /**
     * Sets the JSON data for the response.
     */
    public function setJson(mixed $json): self
    {
        $this->json = $json;

        return $this;
    }

    /**
     * Gets the JSON data of the response.
     */
    public function getJson(): mixed
    {
        return $this->json;
    }

    /**
     * Sends the response to the client.
     */
    public function send(): never
    {
        $this->setContent(json_encode($this->getJson()));

        parent::send();
    }
}
