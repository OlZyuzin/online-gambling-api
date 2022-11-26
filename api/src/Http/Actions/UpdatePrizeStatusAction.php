<?php

namespace OlZyuzin\Http\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Handlers\UpdatePrizeStatus\UpdatePrizeStatusHandler;
use OlZyuzin\Http\Deserializers\UpdatePrizeStatusDeserializer;
use OlZyuzin\Http\Responses\Factories\PrizeResponseFactory;
use OlZyuzinFramework\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UpdatePrizeStatusAction implements ActionInterface
{
    public function __construct(
        private UpdatePrizeStatusHandler $updatePrizeStatusHandler,
    )
    {
    }

    public function checkAuthorized(RequestInterface $request): bool
    {
        return true;
    }

    public function perform(RequestInterface $request): ResponseInterface
    {
        $qp = $request->getQueryParams();
        $prizeId = (int)$qp['id'];

        $json = $request->getBody()->getContents();
        $deserializationResult = UpdatePrizeStatusDeserializer::deserializeJson($json);

        if ($deserializationResult->errors) {
            return new JsonResponse(
                ['errors' => $deserializationResult->errors],
                400,
            );
        }

        $prize = $this
            ->updatePrizeStatusHandler
            ->handle(
                $prizeId,
                $deserializationResult->dto
            );

        return new JsonResponse([
            'data' => PrizeResponseFactory::createDto($prize),
        ]);
    }
}