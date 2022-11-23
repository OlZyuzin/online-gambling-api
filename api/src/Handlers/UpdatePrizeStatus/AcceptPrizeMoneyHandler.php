<?php

namespace OlZyuzin\Handlers\UpdatePrizeStatus;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Banking\BankingInterface;
use OlZyuzin\Handlers\PaymentAccountRepositoryInterface;
use OlZyuzin\Handlers\PrizeMoneyStatus;
use OlZyuzin\Models\Prize\PrizeMoney;
use OlZyuzin\Models\Prize\PrizeMoneyStatus;
use OlZyuzin\Repositories\Interfaces\PaymentAccountRepositoryInterface;

class AcceptPrizeMoneyHandler
{
    public function __construct(
        private BankingInterface $banking,
        private PaymentAccountRepositoryInterface $paymentAccountRepository,
        private EntityManagerInterface $em,
    ) {

    }

    public function handle(
        PrizeMoney $prize,
    ) {
        $paymentAccount = $this
            ->paymentAccountRepository
            ->findByUser($prize->user->id);
        $payoutResult = $this->banking->performPayout(
            $paymentAccount,
            $prize->amount,
        );

        $this->updatePrizeStatus(
            $prize,
            $payoutResult,
        );
    }

    private function updatePrizeStatus(
        PrizeMoney $prize,
        bool $payoutResult
    ): void {
        $status = $payoutResult ?
            PrizeMoneyStatus::ACCEPTED :
            PrizeMoneyStatus::ACCEPTANCE_FAILED;

        $prize->status = $status;

        $this->em->flush();
    }
}