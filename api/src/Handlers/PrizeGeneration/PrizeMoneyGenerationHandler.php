<?php

namespace OlZyuzin\Handlers\PrizeGeneration;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Interfaces\PrizeGenerationInterface;
use OlZyuzin\Models\Prize\PrizeMoney;
use OlZyuzin\Models\Prize\PrizeScore;
use OlZyuzin\Models\User;
use OlZyuzin\Repositories\Interfaces\UserRepositoryInterface;

class PrizeMoneyGenerationHandler implements PrizeGenerationInterface
{
    // TODO fix this hardcode; This value probably should retrieved from bank API
    private int $amountOfMoneyLeft = 1000;
    // TODO get from settings
    private int $max = 1000;
    // TODO get from settings
    private float $moneyToScoreRatio = 1.5;

    public function __construct(
        private EntityManagerInterface      $em,
        private PrizeScoreGenerationHandler $prizeScoreGenerationHandler,
        private UserRepositoryInterface     $userRepository,
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
        // TODO top up should happen via dedicated service which would handle with some bank API
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