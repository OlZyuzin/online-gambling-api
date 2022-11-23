<?php

namespace OlZyuzin\Repositories\Interfaces;

interface SettingRepositoryInterface
{
    public function findMaxScore(): int;
}