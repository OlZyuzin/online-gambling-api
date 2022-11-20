<?php

namespace OlZyuzin\Representation\Requests;

use OlZyuzin\Models\PrizeThingStatus;
use OlZyuzinFramework\Exceptions\InvalidRequestPayloadStructure;
use OlZyuzinFramework\Exceptions\MalformedJsonSyntax;

class PatchPrizeThingReqest
{
    public function __construct(
        public ?PrizeThingStatus $status,
    ) {

    }

    /**
     * @throws MalformedJsonSyntax
     * @throws InvalidRequestPayloadStructure
     */
    public static function initFromJson(string $json): self
    {
        $data = json_decode($json, true);
        if (!is_array($data)) {
            throw new MalformedJsonSyntax();
        }

        if(!isset($data['data'])) {
            throw new InvalidRequestPayloadStructure(['Expected data key in the root of json']);
        }

        $data = $data['data'];
        $status = $data['status'];
        $statusEnum = PrizeThingStatus::tryFrom($status);
        $request = new PatchPrizeThingReqest(
            $statusEnum
        );

        return $request;
    }
}