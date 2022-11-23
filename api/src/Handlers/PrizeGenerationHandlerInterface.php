<?php

namespace OlZyuzin\Handlers;

use OlZyuzin\Models\Prize\Prize;

interface PrizeGenerationHandlerInterface
{
    public function handle(int $userId): Prize;
}