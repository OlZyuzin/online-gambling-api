<?php

namespace OlZyuzin\Handlers;

use OlZyuzin\Models\Prize;
use OlZyuzin\Models\Thing;
use OlZyuzin\Reposotories\ThingRepositoryInterface;

class PrizeThingGenerationHandler implements PrizeGenerationHandlerInterface
{
    public function __construct(
      private ThingRepositoryInterface $thingRepository,
    ){
    }

    public function handle(int $userId): Prize
    {
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