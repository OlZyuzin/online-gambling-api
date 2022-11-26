<?php

namespace OlZyuzinFramework\Utils;

class ResultError
{
    public function __construct(
        public string $error,
        public ?string $details = null,
    ) {
    }
}