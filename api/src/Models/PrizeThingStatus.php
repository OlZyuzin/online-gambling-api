<?php

namespace OlZyuzin\Models;

use ArchTech\Enums\InvokableCases;

enum PrizeThingStatus: string
{
    use InvokableCases;

    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case ACCEPTED = 'accepted';
    case DELIVERY_IN_PROGRESS = 'delivery_in_progress';
    case DELIVERED = 'delivered';

    public static function isChangeAllowed(
        PrizeThingStatus $from,
        PrizeThingStatus $to,
    ): bool {
        $allowedChanges = self::getAllowedChanges($from);

        return in_array(
            $to,
            $allowedChanges
        );
    }

    public static function getAllowedChanges(PrizeThingStatus $status): array
    {
        $schema = [
            self::PENDING() => [
                self::ACCEPTED,
                self::REJECTED,
            ],
            self::REJECTED() => [],
            self::ACCEPTED() => [
                self::DELIVERY_IN_PROGRESS,
            ],
            self::DELIVERY_IN_PROGRESS() => [
                self::DELIVERED,
            ],
            self::DELIVERED() => [],
        ];

        return $schema[$status()];
    }
}