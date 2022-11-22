<?php

namespace OlZyuzinFramework\Utils;

use OlZyuzinFramework\Exceptions\InvalidRequestPayloadStructure;
use OlZyuzinFramework\Exceptions\MalformedJsonSyntax;


class JsonUtil {
    /**
     * @throws InvalidRequestPayloadStructure
     * @throws MalformedJsonSyntax
     */
    public static function extractDataFromJson(string $json): array
    {
        $data = json_decode($json, true);
        if (!is_array($data)) {
            throw new MalformedJsonSyntax();
        }

        if(!isset($data['data'])) {
            throw new InvalidRequestPayloadStructure(['Expected "data" key in the root of json']);
        }

        return $data['data'];
    }
}
