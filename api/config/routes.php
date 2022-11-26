<?php

use OlZyuzin\Http\Actions\GetPrizeAction;
use OlZyuzin\Http\Actions\LoadTestAction;
use OlZyuzin\Http\Actions\UpdatePrizeStatusAction;
use OlZyuzin\Http\Actions\PlayAction;

return [
    '/api/load-test' => [
        'get' => LoadTestAction::class,
    ],
    '/api/play' => [
        'post' => PlayAction::class,
    ],
    '/api/prize' => [
        'get' => GetPrizeAction::class
    ],
    '/api/prize/status' => [
        'patch' => UpdatePrizeStatusAction::class
    ],
];
