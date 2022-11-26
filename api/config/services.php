<?php

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Banking\BankingInterface;
use OlZyuzin\Banking\FakeBankA\Banking;
use OlZyuzin\Banking\FakeBankA\HttpClient as FakeBankAhttpClient;
use OlZyuzin\Repositories\DoctrineRepositories\PaymentAccountRepository;
use OlZyuzin\Repositories\DoctrineRepositories\PrizeMoneyRepository;
use OlZyuzin\Repositories\DoctrineRepositories\PrizeRepository;
use OlZyuzin\Repositories\DoctrineRepositories\PrizeThingRepository;
use OlZyuzin\Repositories\DoctrineRepositories\SettingRepository;
use OlZyuzin\Repositories\DoctrineRepositories\ThingRepository;
use OlZyuzin\Repositories\DoctrineRepositories\UserRepository;
use OlZyuzin\Repositories\Interfaces\PaymentAccountRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\PrizeMoneyRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\PrizeRepositoryInterface;
use OlZyuzin\Repositories\Interfaces\PrizeThingRepositoryInterface;
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
    BankingInterface::class => get(Banking::class),
    FakeBankAhttpClient::class => create(FakeBankAhttpClient::class)->constructor(
      DI\get('fake-bank-a.host'),
        DI\get('fake-bank-a.client-id'),
        DI\get('fake-bank-a.client-secret'),
        DI\get('fake-bank-a.certificate-path'),
        DI\get('fake-bank-a.certificate-password'),
    ),
    PaymentAccountRepositoryInterface::class => get(PaymentAccountRepository::class),
    PrizeThingRepositoryInterface::class => get(PrizeThingRepository::class),
    PrizeMoneyRepositoryInterface::class => get(PrizeMoneyRepository::class),
];
