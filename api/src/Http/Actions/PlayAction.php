<?php

namespace OlZyuzin\Http\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Handlers\PrizeGeneration\PrizeGenerationHandler;
use OlZyuzin\Http\Responses\Factories\PrizeResponseFactory;
use OlZyuzinFramework\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PlayAction implements ActionInterface
{
    public function __construct(
        private PrizeGenerationHandler $prizeGenerationHandler,
    ) {
    }

    public function checkAuthorized(RequestInterface $request): bool
    {
        return true;
    }

    public function perform(RequestInterface $request): ResponseInterface
    {
        $userId = 1;

        $prize = $this->prizeGenerationHandler->handle($userId);

        return new JsonResponse([
            'data' => PrizeResponseFactory::createDto($prize),
        ]);
    }
}