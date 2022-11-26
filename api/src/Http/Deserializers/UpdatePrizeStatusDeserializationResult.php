<?php

namespace OlZyuzin\Http\Deserializers;

use OlZyuzin\Handlers\Dto\UpdatePrizeStatusDto;
use OlZyuzinFramework\Utils\ResultError;

class UpdatePrizeStatusDeserializationResult
{
    /** @var ResultError[] */
    public array $errors = [];

    public UpdatePrizeStatusDto $dto;
}