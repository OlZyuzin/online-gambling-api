<?php

namespace OlZyuzin\Repositories\DoctrineRepositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use OlZyuzin\Models\Prize\PrizeMoney;
use OlZyuzin\Repositories\Interfaces\PrizeMoneyRepositoryInterface;

class PrizeMoneyRepository extends EntityRepository implements PrizeMoneyRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        $class = new ClassMetadata(PrizeMoney::class);
        parent::__construct($em, $class);
    }

    public function findPrize(int $id): ?PrizeMoney
    {
        return $this->find($id);
    }
}