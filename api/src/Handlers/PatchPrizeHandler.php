<?php

namespace OlZyuzin\Handlers;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\Prize;
use OlZyuzin\Models\PrizeThing;
use OlZyuzin\Reposotories\PrizeRepositoryInterface;
use OlZyuzin\Representation\Requests\PatchPrizeThingDto;

class PatchPrizeHandler
{
    public function __construct(
        private PrizeRepositoryInterface $prizeRepository,
        private EntityManagerInterface   $em,
    )
    {
    }

    public function handle(
        int $prizeId,
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