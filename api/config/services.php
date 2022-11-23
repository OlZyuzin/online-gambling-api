<?php

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Reposotories\DoctrineRepositories\PrizeRepository;
use OlZyuzin\Reposotories\DoctrineRepositories\SettingRepository;
use OlZyuzin\Reposotories\DoctrineRepositories\ThingRepository;
use OlZyuzin\Reposotories\DoctrineRepositories\UserRepository;
use OlZyuzin\Reposotories\Interfaces\PrizeRepositoryInterface;
use OlZyuzin\Reposotories\Interfaces\SettingRepositoryInterface;
use OlZyuzin\Reposotories\Interfaces\ThingRepositoryInterface;
use OlZyuzin\Reposotories\Interfaces\UserRepositoryInterface;
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
