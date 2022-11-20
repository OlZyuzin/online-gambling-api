<?php

namespace OlZyuzinFramework\Exceptions;

class InvalidRequestPayloadStructure extends BadRequest
{
    public function getClientMessage(): string
    {
        return 'Invalid request payload structure';
    }
}