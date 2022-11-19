<?php

namespace OlZyuzin\Actions;

use Doctrine\ORM\EntityManagerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use OlZyuzin\Models\PrizeThing;
use OlZyuzin\Models\PrizeThingStatus;
use OlZyuzin\Reposotories\PrizeRepositoryInterface;
use OlZyuzinFramework\ActionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class PatchPrizeAction implements ActionInterface
{
    public function __construct(
        private PrizeRepositoryInterface $prizeRepository,
        private EntityManagerInterface $em,
    ) {
    }

    public function checkAuthorized(RequestInterface $request): bool
    {
        return true;
    }

    public function perform(RequestInterface $request): ResponseInterface
    {
        $userId = 1;
        $qp = $request->getQueryParams();
        $prizeId = (int) $qp['id'];
        /** @var PrizeThing $prize */
        $prize = $this->prizeRepository->findPrize($prizeId);

        $data = $request->getBody()->getContents();
        $data = json_decode($data, true);
        $newStatus = (string) $data['data']['status'];
        $newStatusEnum = PrizeThingStatus::tryFrom($newStatus);
        if ($newStatusEnum) {
            $prize->setStatus($newStatusEnum);
        }

        $this->em->flush();

        return new JsonResponse(['data' => $prize]);
    }
}