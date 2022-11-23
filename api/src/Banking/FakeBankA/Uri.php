<?php

namespace OlZyuzin\Banking\FakeBankA;

use ArchTech\Enums\InvokableCases;

enum Uri: string
{
    use InvokableCases;

    case AUTH = '/api/token';

    case ACCOUNT_DETAILS = '/api/account';

    case PAYOUT = '/api/payout';

}