<?php

namespace OlZyuzin\Models\Transaction;

enum TransactionStatus: string
{
    case INITIAL = 'initial';

    case FAILED = 'failed';

    case SUCCESS = 'success';
}