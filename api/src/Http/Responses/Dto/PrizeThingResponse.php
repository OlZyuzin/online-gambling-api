<?php

namespace OlZyuzin\Http\Responses\Dto;

use OlZyuzin\Models\Prize\PrizeThingStatus;

class PrizeThingResponse extends PrizeResponse
{
    public PrizeThingStatus $status;

    public ThingResponse $thing;
}