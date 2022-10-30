<?php

namespace OlZyuzinFramework;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    public function create(): EntityManagerInterface
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = ORMSetup::createAnnotationMetadataConfiguration(
            [__DIR__ . "/../src/Models"],
            $isDevMode,
            $proxyDir,
            $cache,
            $useSimpleAnnotationReader
        );

        $conn = [
            'dbname' => 'slotagator',
            'user' => 'slotagator',
            'password' => 'slotagator',
            'host' => 'db',
            'driver' => 'pdo_mysql',
        ];


        $entityManager = EntityManager::create($conn, $config);

        return $entityManager;
    }
}