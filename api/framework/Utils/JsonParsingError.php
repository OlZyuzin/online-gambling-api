<?php

namespace OlZyuzinFramework\Utils;

use ArchTech\Enums\InvokableCases;

enum JsonParsingError: string
{
    use InvokableCases;

    case MALFORMED_JSON_SYNTAX = 'Malformed json syntax';

    case INVALID_PAYLOAD_STRUCTURE = 'Invalid payload structure';
}