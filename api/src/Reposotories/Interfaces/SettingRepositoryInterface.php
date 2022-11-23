<?php

namespace OlZyuzin\Reposotories\Interfaces;

interface SettingRepositoryInterface
{
    public function findMaxScore(): int;
}