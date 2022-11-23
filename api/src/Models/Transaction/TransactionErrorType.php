<?php

namespace OlZyuzin\Models\Transaction;

enum TransactionErrorType: string
{
    case INVALID_BANK_CARD = 'invalid error';
    case BANK_CARD_EXPIRED = 'bank card expired';
    case UNKNOWN_ERROR = 'unknown error';
}