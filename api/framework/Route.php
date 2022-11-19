<?php

namespace OlZyuzinFramework;

class Route
{
    public function __construct(
        public string $actionFqcn,
        public string $httpMethod,
    )
    {
    }
}