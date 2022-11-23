<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Interfaces\UpdatePrizeStatusInterface;
use OlZyuzin\Models\Prize\PrizeMoney;

class UpdatePrizeMoneyStatusHandler implements UpdatePrizeStatusInterface
{
    public function __construct(
        private AcceptPrizeMoneyHandler $acceptPrizeMoneyHandler,
        EntityManagerInterface $em,
    )
    {
    }

    public function handle(
        PrizeMoney $prize,
        string     $status,
    )
    {
        if ($status === 'accepted') {
            $this
                ->acceptPrizeMoneyHandler
                ->handle(
                    $prize,
                );
        } elseif ($status === 'rejected') {
            $prize->status = 'rejected';
            $this->em->flush();
        }
    }
}