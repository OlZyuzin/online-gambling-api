<?php

use OlZyuzin\Actions\LoadTestAction;
use OlZyuzin\Actions\PatchPrizeAction;
use OlZyuzin\Actions\PlayAction;
use OlZyuzinFramework\Route;

return [
    '/api/load-test' => new Route(
        LoadTestAction::class,
        'get'
    ),
    '/api/play' => new Route(
        PlayAction::class,
        'post'
    ),
    '/api/prize' => new Route(
        PatchPrizeAction::class,
        'patch'
    ),
];
