<?php

namespace OlZyuzin\Http\Responses\Dto;

use OlZyuzin\Models\Prize\PrizeMoneyStatus;

class PrizeMoneyResponse extends PrizeResponse
{
    public PrizeMoneyStatus $status;

    public int $amount;
}