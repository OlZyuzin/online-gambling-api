<?php

namespace OlZyuzinFramework\Utils;


class JsonUtil {
    public static function extractDataFromJson(string $json): ExtractDataFromJsonResult
    {
        $result = new ExtractDataFromJsonResult();

        $data = json_decode($json, true);
        if (!is_array($data)) {
            $result->errors[] = new ResultError(
                JsonParsingError::MALFORMED_JSON_SYNTAX()
            );
            return $result;
        }

        if(!isset($data['data'])) {
            $result->errors[] = new ResultError(
                JsonParsingError::INVALID_PAYLOAD_STRUCTURE(),
                'Expected "data" key in the root of json'
            );
            return $result;
        }

        $result->data = $data['data'];
        return $result;
    }
}
