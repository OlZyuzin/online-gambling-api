<?php

namespace OlZyuzin\Banking\FakeBankA\Responses;

use Psr\Http\Message\ResponseInterface;

class FailedResponse
{
    public string $message;

    public ResponseErrorCode $code;

    public static function initFromResponse(ResponseInterface $response): self
    {
        $responseContent = $response->getBody()->getContents();
        $responseData = json_decode($responseContent, true);

        $dto = new self();
        $dto->message = $responseData['error']['message'];
        $dto->code = $responseData['error']['code'];

        return $dto;
    }
}