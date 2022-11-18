<?php

namespace OlZyuzin\Models;

enum PrizeThingStatus: string
{
    case PENDING = 'pending';
    case REJECTED = 'rejected';
    case ACCEPTED = 'accepted';
    case DELIVERY_IN_PROGRESS = 'delivery_in_progress';
    case DELIVERED = 'delivered';
}