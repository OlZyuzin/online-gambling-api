<?php

namespace OlZyuzin\Http\Responses\Factories;

use OlZyuzin\Http\Responses\Dto\PrizeMoneyResponse;
use OlZyuzin\Http\Responses\Dto\UserResponse;
use OlZyuzin\Models\Prize\PrizeMoney;

class PrizeMoneyResponseFactory
{
    public static function createDto(
        PrizeMoney $prize,
    ): PrizeMoneyResponse {
        $userDto = new UserResponse($prize->user->id);
        $prizeDto = new PrizeMoneyResponse();
        $prizeDto->id = $prize->id;
        $prizeDto->type = $prize->getType();
        $prizeDto->user = $userDto;
        $prizeDto->status = $prize->status;
        $prizeDto->amount = $prize->amount;

        return $prizeDto;
    }
}