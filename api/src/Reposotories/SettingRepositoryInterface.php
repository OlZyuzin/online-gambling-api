<?php

namespace OlZyuzin\Reposotories;

interface SettingRepositoryInterface
{
    public function findMaxScore(): int;
}