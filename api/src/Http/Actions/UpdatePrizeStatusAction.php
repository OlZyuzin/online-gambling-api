<?php

namespace OlZyuzin\Http\Actions;

use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Handlers\Dto\PatchPrizeThingDto;
use OlZyuzin\Handlers\UpdatePrizeStatus\UpdatePrizeStatusHandler;
use OlZyuzin\Http\Normalizers\UpdatePrizeStatusNormalizer;
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
        $prizeId = (int) $qp['id'];

        $json = $request->getBody()->getContents();
        $dto = UpdatePrizeStatusNormalizer::createDtoFromJson($json);

        $prize = $this->updatePrizeStatusHandler->handle($prizeId, $dto);

        return new JsonResponse(['data' => $prize]);
    }
}