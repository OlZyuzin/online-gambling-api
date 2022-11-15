<?php

namespace OlZyuzin\Handlers;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\PrizeMoney;
use OlZyuzin\Models\PrizeScore;
use OlZyuzin\Models\User;
use OlZyuzin\Reposotories\UserRepositoryInterface;

class PrizeMoneyGenerationHandler implements PrizeGenerationHandlerInterface
{
    private int $amountOfMoneyLeft = 1000;
    private int $max = 1000;
    private float $moneyToScoreRatio = 1.5;

    public function __construct(
        private EntityManagerInterface $em,
        private PrizeScoreGenerationHandler $prizeScoreGenerationHandler,
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function handle($userId): PrizeMoney|PrizeScore
    {
        $money = random_int(1, $this->max);

        if ($money > $this->amountOfMoneyLeft) {
            $score = $this->convertMoneyToScore($money);
            $prize = $this->prizeScoreGenerationHandler->handle($userId, $score);
            return $prize;
        }

        $user = $this->userRepository->findUser($userId);
        $user->topUpBalance($money);
        $prize = $this->createPrize($money, $user);
        $this->em->flush();

        return $prize;
    }

    private function createPrize(int $amount, User $user): PrizeMoney
    {
        $prize = new PrizeMoney();
        $prize->amount = $amount;
        $prize->user = $user;
        $this->em->persist($prize);

        return $prize;
    }

    private function convertMoneyToScore(int $money): int
    {
        return (int) $money * $this->moneyToScoreRatio;
    }
}