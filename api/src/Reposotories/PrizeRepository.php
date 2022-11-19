<?php

namespace OlZyuzin\Reposotories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use OlZyuzin\Models\Prize;

class PrizeRepository extends EntityRepository implements PrizeRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        $class = new ClassMetadata(Prize::class);
        parent::__construct($em, $class);
    }

    public function findPrize(int $id): ?Prize
    {
        return $this->find($id);
    }
}