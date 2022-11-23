<?php

namespace OlZyuzin\Banking;

use OlZyuzin\Models\PaymentAccount;

interface BankingInterface
{
    public function performPayout(
        PaymentAccount $paymentAccount,
        int            $payoutAmount,
    ): bool;
}