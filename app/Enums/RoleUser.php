<?php

namespace App\Enums;

enum RoleUser: string
{
    case ADMIN = 'admin';
    case USER = 'user';

    public static function default(): self
    {
        return self::USER;
    }
}
