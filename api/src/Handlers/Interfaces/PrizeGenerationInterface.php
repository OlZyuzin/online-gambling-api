<?php

namespace OlZyuzin\Handlers\Interfaces;

use OlZyuzin\Models\Prize\Prize;

interface PrizeGenerationInterface
{
    public function handle(int $userId): Prize;
}