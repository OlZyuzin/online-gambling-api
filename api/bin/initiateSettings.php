<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManagerInterface;
use OlZyuzin\Models\Setting;

$builder = new DI\ContainerBuilder();
$builder->useAutowiring(true);
$builder->addDefinitions(__DIR__ . '/../config/parameters.php');
$builder->addDefinitions(__DIR__ . '/../config/services.php');
$container = $builder->build();

$em = $container->get(EntityManagerInterface::class);

echo 'Starting script execution' . PHP_EOL;

// maximum score that could be generated

createSetting(
    $em,
    'max-score',
    '1000',
    'int'
);


echo 'Initiation of settings is finished' . PHP_EOL;

function createSetting(
    EntityManagerInterface $em,
    string $name,
    string $value,
    string $type,
) {
    echo 'Initiate ' . $name . '  setting' . PHP_EOL;
    $maxScore = new Setting();
    $maxScore->name = $name;
    $maxScore->value = $value;
    $maxScore->type = $type;
    $em->persist($maxScore);

    try {
        $em->flush();
    } catch (Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
        echo $name . ' already initialized' . PHP_EOL;
    }
}