<?php

namespace App\Enums;

enum UnityTypeEnum: string
{
    case PreachingPoint = 'preaching_point';
    case Community = 'community';
    case Parish = 'parish';

    // Método para retornar os valores da enum
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
