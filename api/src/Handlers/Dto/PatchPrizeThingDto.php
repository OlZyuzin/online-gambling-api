<?php

namespace OlZyuzin\Handlers\Dto;

use OlZyuzin\Models\Prize\PrizeThingStatus;
use OlZyuzinFramework\Exceptions\InvalidRequestPayloadStructure;
use OlZyuzinFramework\Exceptions\MalformedJsonSyntax;
use OlZyuzinFramework\Utils\JsonUtil;

class PatchPrizeThingDto
{
    public function __construct(
        public ?PrizeThingStatus $status,
    ) {

    }
}