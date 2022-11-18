<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\Thing;

$builder = new DI\ContainerBuilder();
$builder->useAutowiring(true);
$builder->addDefinitions(__DIR__ . '/../../config/parameters.php');
$builder->addDefinitions(__DIR__ . '/../../config/services.php');
$container = $builder->build();

$em = $container->get(EntityManagerInterface::class);

echo 'Starting script execution' . PHP_EOL;

createEntity(
    $em,
    'Teddy bear',
    99,
    2000
);

createEntity(
    $em,
    'Toy car',
    50,
    1400
);

createEntity(
    $em,
    'Deodorant',
    30,
    1000
);


echo 'Initiation of settings is finished' . PHP_EOL;

function createEntity(
    EntityManagerInterface $em,
    string $name,
    int $count,
    int $scoreEquivalent,
) {
    echo 'Add record for "' . $name . '"  ' . PHP_EOL;
    $entity = new Thing();
    $entity->name = $name;
    $entity->count = $count;
    $entity->scoreEquivalent = $scoreEquivalent;
    $em->persist($entity);

    try {
        $em->flush();
    } catch (Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
        echo $name . '" already addded' . PHP_EOL;
    }
}