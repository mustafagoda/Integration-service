<?php

namespace App\Domain\Shared\Enum;

enum ActiveStatusEnum : string
{
    case ACTIVE = 'active';
    case IN_ACTIVE = 'in_active';
    case EXPIRED = 'expired';
    case CANCELLED = 'cancelled';
}
