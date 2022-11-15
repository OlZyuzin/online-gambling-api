<?php

namespace OlZyuzin\Handlers;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\PrizeMoney;
use OlZyuzin\Models\PrizeScore;
use OlZyuzin\Models\User;

class PrizeMoneyGenerationHandler implements PrizeGenerationHandlerInterface
{
    private int $amountOfMoneyLeft = 1000;
    private int $max = 1000;
    private float $moneyToScoreRatio = 1.5;

    public function __construct(
        private EntityManagerInterface $em,
        private PrizeScoreGenerationHandler $prizeScoreGenerationHandler,
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

        $prize = new PrizeMoney();
        $prize->amount = $money;
        $prize->user = $this->em->getReference(User::class, $userId);

        $this->em->persist($prize);
        $this->em->flush();

        return $prize;
    }

    private function convertMoneyToScore(int $money): int
    {
        return (int) $money * $this->moneyToScoreRatio;
    }
}