<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Interfaces\UpdatePrizeStatusInterface;
use OlZyuzin\Models\Prize\PrizeThingStatus;
use OlZyuzin\Repositories\Interfaces\PrizeThingRepositoryInterface;

class UpdatePrizeThingStatusHandler implements UpdatePrizeStatusInterface
{

    public function __construct(
        private PrizeThingRepositoryInterface $prizeRepository,
        private EntityManagerInterface $em,
    )
    {
    }

    public function handle(
        int $prizeId,
        string $status,
    ): void {
        $prize = $this->prizeRepository->findPrize($prizeId);
        $prizeThingStatus = PrizeThingStatus::tryFrom($status);

        if (!$prizeThingStatus instanceof PrizeThingStatus) {
            return;
        }

        $prize->setStatus($prizeThingStatus);

        $this->em->flush();
    }
}