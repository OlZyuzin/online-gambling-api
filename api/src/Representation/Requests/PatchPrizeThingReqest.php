<?php

namespace OlZyuzin\Representation\Requests;

use OlZyuzin\Models\PrizeThingStatus;

class PatchPrizeThingReqest
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
        $request = new PatchPrizeThingReqest(
            $statusEnum
        );

        return $request;
    }
}