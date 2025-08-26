<?php

namespace App\Enums;

enum ActionType: string
{
    case CREATE = 'create';
    case EDIT = 'edit';
    case DELETE = 'delete';

    // Get all values (useful for validation)
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
