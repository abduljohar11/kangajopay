<?php

namespace App\Enums;

enum StatusUser: string
{
    case PENDING = 'pending';
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';

    public static function default(): self
    {
        return self::PENDING;
    }
}
