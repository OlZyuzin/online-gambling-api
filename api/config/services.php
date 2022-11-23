<?php

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Banking\BankingInterface;
use OlZyuzin\Banking\FakeBankA\Banking;
use OlZyuzin\Banking\FakeBankA\HttpClient as FakeBankAhttpClient;
use OlZyuzin\Repositories\DoctrineRepositories\PaymentAccountRepository;
use OlZyuzin\Repositories\DoctrineRepositories\PrizeRepository;
use OlZyuzin\Repositories\DoctrineRepositories\SettingRepository;
use OlZyuzin\Repositories\DoctrineRepositories\ThingRepository;
use OlZyuzin\Repositories\DoctrineRepositories\UserRepository;
use OlZyuzin\Repositories\Interfaces\PaymentAccountRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\PrizeRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\SettingRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\ThingRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\UserRepositoryInterface;
use OlZyuzinFramework\EntityManagerFactory;
use function DI\create;
use function DI\get;

return [
    EntityManagerFactory::class => create(EntityManagerFactory::class)->constructor(
        DI\get('db.name'),
        DI\get('db.user'),
        DI\get('db.password'),
        DI\get('db.host'),
    ),
    EntityManagerInterface::class => function (Psr\Container\ContainerInterface $c) {
        $factory = $c->get(EntityManagerFactory::class);
        $em = $factory->create();
        return $em;
    },
    UserRepositoryInterface::class => get(UserRepository::class),
    SettingRepositoryInterface::class => get(SettingRepository::class),
    ThingRepositoryInterface::class => get(ThingRepository::class),
    PrizeRepositoryInterface::class => get(PrizeRepository::class),
];
