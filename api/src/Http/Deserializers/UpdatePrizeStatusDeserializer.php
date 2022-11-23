<?php

namespace OlZyuzin\Http\Deserializers;

use OlZyuzin\Handlers\Dto\UpdatePrizeStatusDto;
use OlZyuzinFramework\Exceptions\InvalidRequestPayloadStructure;
use OlZyuzinFramework\Exceptions\MalformedJsonSyntax;
use OlZyuzinFramework\Utils\JsonUtil;

class UpdatePrizeStatusDeserializer
{
    /**
     * @throws MalformedJsonSyntax
     * @throws InvalidRequestPayloadStructure
     */
    public static function deserializeJson(string $json): UpdatePrizeStatusDto
    {
        $data = JsonUtil::extractDataFromJson($json);
        $status = $data['status'];
        $dto = new UpdatePrizeStatusDto(
            $status,
        );

        return $dto;
    }
}