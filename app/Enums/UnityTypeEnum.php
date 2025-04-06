<?php

namespace App\Enums;


use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
enum UnityTypeEnum: string implements HasLabel, HasColor, HasIcon
{
    case PreachingPoint = 'preaching_point';
    case Community = 'community';
    case Parish = 'parish';

    // Método para retornar os valores da enum
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PreachingPoint => 'Ponto de Pregação',
            self::Community => 'Comunidade',
            self::Parish => 'Paróquia',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PreachingPoint => 'warning',
            self::Community => 'success',
            self::Parish => 'info',
        };
    }
    public function getIcon(): ?string
    {
        return match($this)
        {
            self::PreachingPoint => 'heroicon-o-home-modern',
            self::Community => 'heroicon-o-building-library',
            self::Parish => 'heroicon-o-map-pin',
        };
    }   
}
