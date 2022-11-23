<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Interfaces\UpdatePrizeStatusInterface;
use OlZyuzin\Models\Prize\PrizeThing;
use OlZyuzin\Models\Prize\PrizeThingStatus;

class UpdatePrizeThingStatusHandler implements UpdatePrizeStatusInterface
{

    public function __construct(
        private EntityManagerInterface $em,
    )
    {
    }

    public function handle(
        PrizeThing $prize,
        string $status,
    ) {
        $prizeThingStatus = PrizeThingStatus::tryFrom($status);
        $prize->setStatus($prizeThingStatus);

        $this->em->flush();
    }
}