<?php

use OlZyuzin\Actions\LoadTestAction;
use OlZyuzin\Actions\PatchPrizeAction;
use OlZyuzin\Actions\PlayAction;

return [
    '/api/load-test' => [
        'get' => LoadTestAction::class,
    ],
    '/api/play' => [
        'post' => PlayAction::class,
    ],
    '/api/prize' => [
        'patch' => PatchPrizeAction::class
    ],
];
