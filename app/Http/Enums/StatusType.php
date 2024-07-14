<?php

namespace App\Http\Enums;

enum StatusType: string
{
    case PENDING = 'Kutilmoqda';
    case APPROVED = 'Tasdiqlandi';
    case REJECTED = 'Rad etildi';
    case COMPLETED = 'Tugatildi';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
