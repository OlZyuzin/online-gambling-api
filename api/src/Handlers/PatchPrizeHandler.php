<?php

namespace OlZyuzin\Handlers;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Dto\PatchPrizeThingDto;
use OlZyuzin\Models\Prize\Prize;
use OlZyuzin\Models\Prize\PrizeThing;
use OlZyuzin\Reposotories\Interfaces\PrizeRepositoryInterface;

class PatchPrizeHandler
{
    public function __construct(
        private PrizeRepositoryInterface $prizeRepository,
        private EntityManagerInterface   $em,
    )
    {
    }

    public function handle(
        int                $prizeId,
        PatchPrizeThingDto $dto,
    ): Prize {
        /** @var PrizeThing $prize */
        $prize = $this->prizeRepository->findPrize($prizeId);

        if ($dto->status) {
            $prize->setStatus($dto->status);
        }

        $this->em->flush();

        return $prize;
    }
}