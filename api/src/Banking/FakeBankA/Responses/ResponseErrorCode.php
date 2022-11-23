<?php

namespace OlZyuzin\Banking\FakeBankA\Responses;

use ArchTech\Enums\InvokableCases;
use OlZyuzin\Models\Transaction\TransactionErrorType;

enum ResponseErrorCode: string
{
    use InvokableCases;

    case INVALID_CARD_NUMBER = 'e0001';

    case CARD_EXPIRED = 'e0002';

    case UNKNOWN = 'e0000';

    public static function translateIntoErrorType(self $code): TransactionErrorType
    {
        $map = [
            self::INVALID_CARD_NUMBER() => TransactionErrorType::INVALID_BANK_CARD,
            self::CARD_EXPIRED() => TransactionErrorType::BANK_CARD_EXPIRED,
            self::UNKNOWN() => TransactionErrorType::UNKNOWN_ERROR,
        ];

        $result = TransactionErrorType::UNKNOWN_ERROR;

        if (isset($map[$code()])) {
            $result = $map[$code()];
        }

        return $result;
    }
}