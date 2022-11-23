<?php

namespace OlZyuzin\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Handlers\PatchPrizeHandler;
use OlZyuzin\Representation\Requests\PatchPrizeThingReqest;
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
        $dto = PatchPrizeThingReqest::initFromJson($json);

        $prize = $this->patchPrizeHandler->handle($prizeId, $dto);

        return new JsonResponse(['data' => $prize]);
    }
}