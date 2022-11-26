<?php

namespace OlZyuzin\Http\Deserializers;

use OlZyuzin\Handlers\Dto\UpdatePrizeStatusDto;
use OlZyuzinFramework\Utils\JsonUtil;

class UpdatePrizeStatusDeserializer
{
    public static function deserializeJson(string $json): UpdatePrizeStatusDeserializationResult
    {
        $result = new UpdatePrizeStatusDeserializationResult();
        $extractResult = JsonUtil::extractDataFromJson($json);

        if (!empty($extractResult)) {
            $result->errors = $extractResult->errors;
            return $result;
        }

        $status = $extractResult->data['status'];
        $result->dto = new UpdatePrizeStatusDto(
            $status,
        );

        return $result;
    }
}