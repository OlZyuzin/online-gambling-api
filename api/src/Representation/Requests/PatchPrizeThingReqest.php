<?php

namespace OlZyuzin\Representation\Requests;

use OlZyuzin\Models\PrizeThingStatus;
use OlZyuzinFramework\Exceptions\InvalidRequestPayloadStructure;
use OlZyuzinFramework\Exceptions\MalformedJsonSyntax;
use OlZyuzinFramework\Utils\JsonUtil;

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
        $data = JsonUtil::extractDataFromJson($json);
        $status = $data['status'];
        $statusEnum = PrizeThingStatus::tryFrom($status);
        $request = new PatchPrizeThingReqest(
            $statusEnum
        );

        return $request;
    }
}