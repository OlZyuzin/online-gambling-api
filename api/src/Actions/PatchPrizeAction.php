<?php

namespace OlZyuzin\Actions;

use Doctrine\ORM\EntityManagerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Handlers\PatchPrizeHandler;
use OlZyuzin\Models\PrizeThing;
use OlZyuzin\Reposotories\PrizeRepositoryInterface;
use OlZyuzin\Representation\Requests\PatchPrizeThingDto;
use OlZyuzinFramework\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PatchPrizeAction implements ActionInterface
{
    public function __construct(
        private PatchPrizeHandler $patchPrizeHandler,
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
        $prizeId = (int) $qp['id'];

        $json = $request->getBody()->getContents();
        $dto = PatchPrizeThingDto::initFromJson($json);

        $prize = $this->patchPrizeHandler->handle($prizeId, $dto);

        return new JsonResponse(['data' => $prize]);
    }
}