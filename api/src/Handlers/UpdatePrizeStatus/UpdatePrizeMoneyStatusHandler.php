<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Interfaces\UpdatePrizeStatusInterface;
use OlZyuzin\Models\Prize\PrizeMoneyStatus;
use OlZyuzin\Repositories\Interfaces\PrizeMoneyRepositoryInterface;

class UpdatePrizeMoneyStatusHandler implements UpdatePrizeStatusInterface
{
    public function __construct(
        private PrizeMoneyRepositoryInterface $prizeRepository,
        private AcceptPrizeMoneyHandler $acceptPrizeMoneyHandler,
        private EntityManagerInterface $em,
    )
    {
    }

    public function handle(
        int $prizeId,
        string     $status,
    ): void {
        /**
         * Most likely scenario is that this handler was called in @see UpdatePrizeStatusHandler::handle
         * And it should be noticed that the same prize entity was already retrieved by doctrine repository
         * and yet here that same entity is retrieved again via doctrine repository
         * therefore concern might be raised.
         * Wouldn't it imply that redundant database select query is made?
         * Actually no.
         * No extra database query is made here.
         * Entity is retrieved from unit of work identity map.
         * The same entity which was retrieved during UpdatePrizeStatusHandler::handle
         */
        $prize = $this->prizeRepository->findPrize($prizeId);

        if ($status === PrizeMoneyStatus::ACCEPTED()) {
            $this
                ->acceptPrizeMoneyHandler
                ->handle(
                    $prize,
                );
        } elseif ($status === PrizeMoneyStatus::REJECTED()) {
            $prize->status = PrizeMoneyStatus::REJECTED;
            $this->em->flush();
        } else {
            // If status not defined  in the scope of enum just do nothing
        }
    }
}