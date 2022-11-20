<?php

namespace OlZyuzinFramework\Exceptions;

class BadRequest extends HttpException
{
    public function getStatusCode(): int
    {
        return 400;
    }

    public function getClientMessage(): string
    {
        return 'Bad request';
    }
}