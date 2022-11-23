<?php

namespace OlZyuzin\Handlers\Dto;

class UpdatePrizeStatusDto
{
    public function __construct(
        public string $status,
    ) {
    }
}