<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\Prize\PrizeMoney;
use OlZyuzin\Models\Prize\PrizeMoneyStatus;

class UpdatePrizeMoneyStatusHandler
{
    public function __construct(
        private AcceptPrizeMoneyHandler $acceptPrizeMoneyHandler,
        private EntityManagerInterface $em,
    )
    {
    }

    public function handle(
        PrizeMoney $prize,
        string     $status,
    ): void {
        if ($status === PrizeMoneyStatus::ACCEPTED()) {
            $this
                ->acceptPrizeMoneyHandler
                ->handle(
                    $prize,
                );
        } elseif ($status === PrizeMoneyStatus::REJECTED()) {
            $prize->status = PrizeMoneyStatus::REJECTED;
            $this->em->flush();
        }
    }
}