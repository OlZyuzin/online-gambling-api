<?php

namespace OlZyuzin\Http\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Handlers\Dto\PatchPrizeThingDto;
use OlZyuzin\Handlers\PatchPrizeHandler;
use OlZyuzin\Http\Normalizers\PatchPrizeThingNormalizer;
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
        $dto = PatchPrizeThingNormalizer::createDtoFromJson($json);

        $prize = $this->patchPrizeHandler->handle($prizeId, $dto);

        return new JsonResponse(['data' => $prize]);
    }
}