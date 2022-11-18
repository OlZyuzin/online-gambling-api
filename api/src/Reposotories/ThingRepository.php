<?php

namespace OlZyuzin\Reposotories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use OlZyuzin\Models\Thing;

class ThingRepository extends EntityRepository implements ThingRepositoryInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $class = new ClassMetadata(Thing::class);
        parent::__construct($em, $class);
    }

    /**
     * @inheritDoc
     */
    public function findAvailable(): array
    {
        $qb = $this->createQueryBuilder('t');
        $expr = $qb->expr();
        $qb->andWhere($expr->gt(
            't.count',
            't.reservedCount'
        ));
        return $qb->getQuery()->getResult();
    }
}