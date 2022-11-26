<?php

namespace OlZyuzin\Repositories\Interfaces;

use OlZyuzin\Models\Prize\PrizeMoney;

interface PrizeMoneyRepositoryInterface
{
    public function findPrize(int $id): ?PrizeMoney;
}