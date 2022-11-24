<?php

namespace OlZyuzin\Http\Responses\Factories;

use OlZyuzin\Http\Responses\Dto\PrizeThingResponse;
use OlZyuzin\Http\Responses\Dto\ThingResponse;
use OlZyuzin\Http\Responses\Dto\UserResponse;
use OlZyuzin\Models\Prize\PrizeThing;

class PrizeThingResponseFactory
{
    public static function createDto(
        PrizeThing $prize,
    ): PrizeThingResponse {
        $thingDto = new ThingResponse();
        $thingDto->id = $prize->thing->id;
        $userDto = new UserResponse($prize->user->id);
        $prizeDto = new PrizeThingResponse();
        $prizeDto->id = $prize->id;
        $prizeDto->type = $prize->getType();
        $prizeDto->user = $userDto;
        $prizeDto->status = $prize->getStatus();
        $prizeDto->thing = $thingDto;

        return $prizeDto;
    }
}