<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'ADMIN';
    case SUPER_ADMIN = 'SUPER_ADMIN';
    case CUSTOMER = 'CUSTOMER';
}
