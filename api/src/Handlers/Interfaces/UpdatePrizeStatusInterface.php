<?php

namespace OlZyuzin\Handlers\Interfaces;

use OlZyuzin\Models\Prize\Prize;

interface UpdatePrizeStatusInterface
{
    public function handle(
        Prize  $prize,
        string $status,
    ): void;
}