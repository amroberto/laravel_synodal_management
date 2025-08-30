<?php

declare(strict_types=1);

namespace App\Enums;

enum OfferTypeEnum: string
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

    public static function getValues(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::LOCAL => 'Local',
            self::SINODAL => 'Sinodal',
            self::NACIONAL => 'Nacional',
            self::ESPECIAL => 'Especial'
        };
    }


}
