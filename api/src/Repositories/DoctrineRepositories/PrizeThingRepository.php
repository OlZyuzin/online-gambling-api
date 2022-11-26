<?php

namespace OlZyuzin\Repositories\DoctrineRepositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use OlZyuzin\Models\Prize\PrizeThing;
use OlZyuzin\Repositories\Interfaces\PrizeThingRepositoryInterface;

class PrizeThingRepository extends EntityRepository implements PrizeThingRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        $class = new ClassMetadata(PrizeThing::class);
        parent::__construct($em, $class);
    }

    public function findPrize(int $id): ?PrizeThing
    {
        return $this->find($id);
    }
}