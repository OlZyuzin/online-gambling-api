<?php

namespace OlZyuzin\Representation\Requests;

use OlZyuzin\Models\PrizeThingStatus;

class PatchPrizeThingDto
{
    public function __construct(
        public ?PrizeThingStatus $status,
    ) {

    }

    public static function initFromJson(string $json): self
    {
        $data = json_decode($json, true);
        $data = $data['data'];
        $status = $data['status'];
        $statusEnum = PrizeThingStatus::tryFrom($status);
        $request = new PatchPrizeThingDto(
            $statusEnum
        );

        return $request;
    }
}