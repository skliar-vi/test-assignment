<?php

declare(strict_types=1);

namespace App\Http\Response;

use App\Http\Enum\HttpStatusCodes;

class JsonResponse extends Response
{
    private mixed $json = null;

    public function __construct(mixed $json = null, int|HttpStatusCodes $statusCode = HttpStatusCodes::OK, array $headers = [])
    {
        parent::__construct('', $statusCode, $headers);

        $this->setHeader('Content-Type', 'application/json');
        $this->setJson($json);
    }

    /**
     * @param mixed $json
     * @return $this
     */
    public function setJson(mixed $json): self
    {
        $this->json = $json;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJson(): mixed
    {
        return $this->json;
    }

    /**
     * @return never
     */
    public function send(): never
    {
        $this->setContent(json_encode($this->getJson()));

        parent::send();
    }
}
