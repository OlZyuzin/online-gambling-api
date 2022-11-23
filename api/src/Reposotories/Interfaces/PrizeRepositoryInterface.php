<?php

namespace OlZyuzin\Reposotories\Interfaces;

use OlZyuzin\Models\Prize\Prize;

interface PrizeRepositoryInterface
{
    public function findPrize(int $id): ?Prize;
}