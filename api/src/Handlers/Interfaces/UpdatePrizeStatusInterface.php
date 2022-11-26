<?php

namespace OlZyuzin\Handlers\Interfaces;

interface UpdatePrizeStatusInterface
{
    public function handle(
        int $prizeId,
        string $status,
    ): void;
}