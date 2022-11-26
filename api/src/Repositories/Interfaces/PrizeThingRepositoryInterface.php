<?php

namespace OlZyuzin\Repositories\Interfaces;


use OlZyuzin\Models\Prize\PrizeThing;

interface PrizeThingRepositoryInterface
{
    public function findPrize(int $id): ?PrizeThing;
}