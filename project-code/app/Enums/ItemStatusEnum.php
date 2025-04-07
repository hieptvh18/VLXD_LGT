<?php

namespace App\Enums;

enum ItemStatusEnum: string
{
    case DISABLE = 'DISABLE';
    case ON_SALE = 'ON_SALE';
    case OPEN_SALE = 'OPEN_SALE';
    case SOLD = 'SOLD';
}
