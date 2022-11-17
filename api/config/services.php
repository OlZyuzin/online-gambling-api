<?php

return [
    \OlZyuzinFramework\EntityManagerFactory::class => \DI\create(\OlZyuzinFramework\EntityManagerFactory::class)->constructor(
        DI\get('db.name'),
        DI\get('db.user'),
        DI\get('db.password'),
        DI\get('db.host'),
    ),
    \Doctrine\ORM\EntityManagerInterface::class => function (Psr\Container\ContainerInterface $c) {
        $factory = $c->get(\OlZyuzinFramework\EntityManagerFactory::class);
        $em = $factory->create();
        return $em;
    },
    \OlZyuzin\Reposotories\UserRepositoryInterface::class => \DI\get(\OlZyuzin\Reposotories\UserRepository::class),
];
