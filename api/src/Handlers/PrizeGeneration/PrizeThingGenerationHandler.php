<?php

namespace OlZyuzin\Handlers\PrizeGeneration;

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Handlers\Interfaces\PrizeGenerationInterface;
use OlZyuzin\Models\Prize\PrizeScore;
use OlZyuzin\Models\Prize\PrizeThing;
use OlZyuzin\Models\Thing;
use OlZyuzin\Models\User;
use OlZyuzin\Repositories\Interfaces\ThingRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\UserRepositoryInterface;

class PrizeThingGenerationHandler implements PrizeGenerationInterface
{
    public function __construct(
        private EntityManagerInterface      $em,
        private PrizeScoreGenerationHandler $prizeScoreGenerationHandler,
        private ThingRepositoryInterface    $thingRepository,
        private UserRepositoryInterface     $userRepository,
    )
    {
    }

    public function handle(int $userId): PrizeThing|PrizeScore
    {
        $thing = $this->getRandomThing();

        if (!$thing) {
            $prize = $this->prizeScoreGenerationHandler->handle($userId);
            return $prize;
        }

        $thing->incrementReservedCount();
        $user = $this->userRepository->findUser($userId);
        $prize = $this->createPrize($user, $thing);
        $this->em->flush();

        return $prize;
    }

    private function createPrize(
        User $user,
        Thing $thing,
    ): PrizeThing {
        $prize = new PrizeThing();
        $prize->thing = $thing;
        $prize->user = $user;
        $this->em->persist($prize);

        return $prize;
    }

    /**
     * TODO make binary search of enclosing range for generated random value
     * TODO break into smaller methods
     *
     * Get random thing based on currently available count of each thing
     * the bigger current available count - the bigger chance it will be randomly chosen
     */
    private function getRandomThing(): ?Thing
    {
        $entities = $this->thingRepository->findAvailable();

        if (empty($entities)) {
            return null;
        }

        /** @var Thing[] $indexedEntities */
        $indexedEntities = [];
        $previousRange = 0;
        foreach ($entities as $entity) {
            $indexedEntities[$previousRange + $entity->getAvailableCount()] = $entity;
            $previousRange += $entity->getAvailableCount();
        }

        $maxRandomValue = $previousRange;

        $randomValue = random_int(1, $maxRandomValue);

        // Find enclosing range for generated random value
        foreach ($indexedEntities as $range => $entity) {
            if ($range < $randomValue) {
                continue;
            } else {
                $enclosingRange = $range;
                break;
            }
        }

        return $indexedEntities[$enclosingRange];
    }

}