<?php

namespace OlZyuzin\Handlers\PrizeGeneration;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Interfaces\PrizeGenerationInterface;
use OlZyuzin\Models\Prize\PrizeScore;
use OlZyuzin\Models\User;
use OlZyuzin\Repositories\Interfaces\SettingRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\UserRepositoryInterface;

class PrizeScoreGenerationHandler implements PrizeGenerationInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepositoryInterface $userRepository,
        private SettingRepositoryInterface $settingRepository,
    ) {
    }

    public function handle(int $userId, ?int $score = null): PrizeScore
    {
        if (!$score) {
            $score = random_int(
                1,
                $this->settingRepository->findMaxScore()
            );
        }

        $user = $this->userRepository->findUser($userId);
        $user->topUpScore($score);
        $prize = $this->createPrize($score, $user);

        $this->em->flush();

        return $prize;
    }

    private function createPrize(int $score, User $user): PrizeScore
    {
        $prize = new PrizeScore();
        $prize->amount = $score;
        $prize->user = $user;

        $this->em->persist($prize);

        return $prize;
    }
}