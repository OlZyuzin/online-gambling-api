<?php

namespace OlZyuzin\Repositories\DoctrineRepositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use OlZyuzin\Models\PaymentAccount;
use OlZyuzin\Repositories\Interfaces\PaymentAccountRepositoryInterface;

class PaymentAccountRepository extends EntityRepository implements PaymentAccountRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        $class  = new ClassMetadata(PaymentAccount::class);
        parent::__construct($em, $class);
    }

    public function findByUser(int $userId): ?PaymentAccount
    {
        return $this->findOneBy(
            ['user' => $userId]
        );
    }

}