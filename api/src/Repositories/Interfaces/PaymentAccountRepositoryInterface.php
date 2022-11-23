<?php

namespace OlZyuzin\Repositories\Interfaces;

use OlZyuzin\Models\PaymentAccount;

interface PaymentAccountRepositoryInterface
{
    public  function findByUser(int $userId): ?PaymentAccount;
}