<?php

namespace App\Enums;

enum OfferTypeEnum : string
{
    case LOCAL = 'local';
    case SINODAL = 'sinodal';
    case NACIONAL = 'nacional';
    case ESPECIAL = 'especial';

    // Método para retornar os valores da enum
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
