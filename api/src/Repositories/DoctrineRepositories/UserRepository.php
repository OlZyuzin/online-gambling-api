<?php

namespace OlZyuzin\Repositories\DoctrineRepositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use OlZyuzin\Models\User;
use OlZyuzin\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        $class = new ClassMetadata(User::class);
        parent::__construct($em, $class);
    }


    public function findUser(int $id): ?User
    {
       return $this->find($id);
    }
}