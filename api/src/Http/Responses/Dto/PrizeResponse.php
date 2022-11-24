<?php

namespace OlZyuzin\Http\Responses\Dto;

use OlZyuzin\Models\Prize\PrizeType;

class PrizeResponse
{
    public int $id;

    public PrizeType $type;

    public UserResponse $user;
}