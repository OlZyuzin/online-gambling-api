<?php

namespace OlZyuzin\Handlers;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\PrizeScore;
use OlZyuzin\Models\User;
use OlZyuzin\Reposotories\UserRepositoryInterface;

class PrizeScoreGenerationHandler
{
    private int $maxScore = 1000;

    public function __construct(
        private EntityManagerInterface $em,
        private UserRepositoryInterface $userRepository,
    ) {
    }

    public function handle(int $userId, ?int $score = null): PrizeScore
    {
        if (!$score) {
            $score = random_int(1, $this->maxScore);
        }

        $user = $this->userRepository->findUser($userId);
        $user->score += $score;
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