<?php

namespace OlZyuzin\Models\Prize;

use ArchTech\Enums\InvokableCases;

enum PrizeType: string
{
    use  InvokableCases;

    case Score = 'score';
    case Thing = 'thing';
    case Money = 'money';
}