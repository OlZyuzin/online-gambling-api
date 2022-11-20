<?php

namespace OlZyuzinFramework\Exceptions;

class MalformedJsonSyntax extends BadRequest
{
    public function getClientMessage(): string
    {
        return 'Malformed json syntax';
    }
}