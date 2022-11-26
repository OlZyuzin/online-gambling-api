<?php

namespace OlZyuzin\Http\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Http\Responses\Factories\PrizeResponseFactory;
use OlZyuzin\Repositories\Interfaces\PrizeRepositoryInterface;
use OlZyuzinFramework\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetPrizeAction implements ActionInterface
{
    public function __construct(
        private PrizeRepositoryInterface $prizeRepository
    ) {

    }

    public function checkAuthorized(RequestInterface $request): bool
    {
        return true;
    }

    public function perform(RequestInterface $request): ResponseInterface
    {
        $qp = $request->getQueryParams();
        $prizeId = (int) $qp['id'];

        $prize = $this->prizeRepository->findPrize($prizeId);

        return new JsonResponse([
            'data' => PrizeResponseFactory::createDto($prize),
        ]);
    }
}