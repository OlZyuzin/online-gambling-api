<?php

namespace OlZyuzin\Reposotories;

use OlZyuzin\Models\Prize;

interface PrizeRepositoryInterface
{
    public function findPrize(int $id): ?Prize;
}