<?php

namespace OlZyuzin\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Handlers\PrizeGenerationHandler;
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
        var_dump($this->prizeGenerationHandler);
        return new JsonResponse([
            'data' => [
                'status' => 'success',
                'route' => 'play',
            ]
        ]);
    }
}