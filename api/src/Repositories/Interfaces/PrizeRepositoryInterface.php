<?php

namespace OlZyuzin\Repositories\Interfaces;

use OlZyuzin\Models\Prize\Prize;

interface PrizeRepositoryInterface
{
    public function findPrize(int $id): ?Prize;
}