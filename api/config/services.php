<?php

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Reposotories\SettingRepository;
use OlZyuzin\Reposotories\SettingRepositoryInterface;
use OlZyuzin\Reposotories\ThingRepository;
use OlZyuzin\Reposotories\ThingRepositoryInterface;
use OlZyuzin\Reposotories\UserRepository;
use OlZyuzin\Reposotories\UserRepositoryInterface;
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
    ThingRepositoryInterface::class => get(ThingRepository::class)
];
