<?php

namespace OlZyuzin\Handlers;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\PrizeScore;
use OlZyuzin\Models\User;

class PrizeScoreGenerationHandler
{
    private int $maxScore = 1000;

    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function handle($userId): PrizeScore
    {
        $score = random_int(1, $this->maxScore);

        $prize = new PrizeScore();
        $prize->amount = $score;
        $prize->user = $this->em->getReference(User::class, $userId);

        $this->em->persist($prize);
        $this->em->flush();

        return $prize;
    }
}