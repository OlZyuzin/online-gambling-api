<?php

return [
    \Doctrine\ORM\EntityManagerInterface::class => function (Psr\Container\ContainerInterface $c) {
        $factory = new \OlZyuzinFramework\EntityManagerFactory();
        $em = $factory->create();
        return $em;
    },
    \OlZyuzin\Reposotories\UserRepositoryInterface::class => \DI\get(\OlZyuzin\Reposotories\UserRepository::class),
    \OlZyuzin\Handlers\PrizeGenerationHandler::class => DI\autowire()->constructorParameter('okok', DI\get('okok'))
];
