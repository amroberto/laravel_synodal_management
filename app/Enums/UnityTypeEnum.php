<?php

namespace App\Enums;

enum UnityTypeEnum: string
{
    case PREACHINGPOINT = 'preaching_point';
    case COMMUNITY = 'community';
    case PARISH = 'parish';

    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
    
    public static function getLabels(): array
    {
        return [
            self::PREACHINGPOINT->value => 'Ponto de Pregação',
            self::COMMUNITY->value => 'Comunidade',
            self::PARISH->value => 'Paróquia',
        ];
    }

    public function label():string
    {
        return match ($this) {
            self::PREACHINGPOINT => 'Ponto de Pregação',
            self::COMMUNITY => 'Comunidade',
            self::PARISH => 'Paróquia',
        };
    }
}
