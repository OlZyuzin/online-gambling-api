<?php

namespace OlZyuzinFramework;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    public function __construct(
        private string $dbName,
        private string $dbUser,
        private string $dbPassword,
        private string $dbHost,
    )
    {
    }

    public function create(): EntityManagerInterface
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . "/../src/Models"],
            isDevMode: true,
        );

        $conn = [
            'dbname' => $this->dbName,
            'user' => $this->dbUser,
            'password' => $this->dbPassword,
            'host' => $this->dbHost,
            'driver' => 'pdo_mysql',
        ];


        $entityManager = EntityManager::create($conn, $config);

        return $entityManager;
    }
}