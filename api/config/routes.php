<?php

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
    '/api/prize/status' => [
        'patch' => UpdatePrizeStatusAction::class
    ],
];
