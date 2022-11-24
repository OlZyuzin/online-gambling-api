<?php

namespace OlZyuzin\Http\Responses\Factories;

use OlZyuzin\Http\Responses\Dto\PrizeResponse;
use OlZyuzin\Models\Prize\Prize;
use OlZyuzin\Models\Prize\PrizeType;

class PrizeResponseFactory
{
    public static function createDto(Prize $prize): PrizeResponse
    {
        $specificTypeFactory = self::getFactoryForSpecificType($prize->getType());

        $dto = $specificTypeFactory::createDto($prize);


        return $dto;
    }

    private static function getFactoryForSpecificType(PrizeType $type): string
    {
        $factories = [
            PrizeType::Score() => PrizeScoreResponseFactory::class,
            PrizeType::Thing() => PrizeThingResponseFactory::class,
            PrizeType::Money() => PrizeMoneyResponseFactory::class,
        ];

        return $factories[$type()];
    }
}