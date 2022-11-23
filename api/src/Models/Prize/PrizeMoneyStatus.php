<?php

namespace OlZyuzin\Models\Prize;

use ArchTech\Enums\InvokableCases;

enum PrizeMoneyStatus: string
{
    use InvokableCases;

    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case ACCEPTED = 'accepted';
    case ACCEPTANCE_FAILED = 'acceptance_failed';
}