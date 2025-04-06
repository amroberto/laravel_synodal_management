<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum OfferTypeEnum: string implements HasLabel, HasColor, HasIcon
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

    public function getLabel(): ?string
    {
        return match ($this) {
            self::LOCAL => 'Local',
            self::SINODAL => 'Sinodal',
            self::NACIONAL => 'Nacional',
            self::ESPECIAL => 'Especial'
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::LOCAL => 'warning',
            self::SINODAL => 'success',
            self::NACIONAL => 'danger',
            SELF::ESPECIAL => 'info',
        };
    }

        public function getIcon(): ?string
    {
        return match($this)
        {
            self::LOCAL => 'heroicon-o-home',
            self::SINODAL => 'heroicon-o-check-badge',
            self::NACIONAL => 'heroicon-o-globe-alt',
            self::ESPECIAL => 'heroicon-o-globe-alt',
        };
    }
}
