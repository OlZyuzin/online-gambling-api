<?php

namespace OlZyuzin\Banking\FakeBankA\Responses;

use Psr\Http\Message\ResponseInterface;

class GetAccountDetailsResponse
{
    public int $balance;

    public int $statusCode;

    public static function initFromResponse(ResponseInterface $response): self
    {
        $responseContent = $response->getBody()->getContents();
        $responseData = json_decode($responseContent, true);

        $dto = new self();
        $dto->balance = $responseData['account']['balance'];
        $dto->statusCode = $response->getStatusCode();

        return $dto;
    }
}