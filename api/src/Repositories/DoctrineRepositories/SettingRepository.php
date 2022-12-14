<?php

namespace OlZyuzin\Repositories\DoctrineRepositories;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use OlZyuzin\Models\Setting;
use OlZyuzin\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepository extends EntityRepository implements SettingRepositoryInterface
{
    public function __construct(EntityManagerInterface $em)
    {
        $class = new ClassMetadata(Setting::class);
        parent::__construct($em, $class);
    }

    public function findMaxScore(): int
    {
        $setting = $this->find('max-score');
        return (int) $setting->value;
    }

}