<?php

namespace OlZyuzin\Http\Responses\Factories;

use OlZyuzin\Http\Responses\Dto\PrizeScoreResponse;
use OlZyuzin\Http\Responses\Dto\UserResponse;
use OlZyuzin\Models\Prize\PrizeScore;

class PrizeScoreResponseFactory
{
    public static function createDto(
        PrizeScore $prize,
    ): PrizeScoreResponse {
        $userDto = new UserResponse($prize->user->id);
        $prizeDto = new PrizeScoreResponse();
        $prizeDto->id = $prize->id;
        $prizeDto->type = $prize->getType();
        $prizeDto->user = $userDto;
        $prizeDto->amount = $prize->amount;

        return $prizeDto;
    }
}