<?php

use OlZyuzin\Http\Actions\LoadTestAction;
use OlZyuzin\Http\Actions\PatchPrizeAction;
use OlZyuzin\Http\Actions\PlayAction;

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
