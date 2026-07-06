<?php

namespace App\Enums;

enum UnityTypeEnum: string
{
    private const PREACHINGPOINT_LABEL = 'Ponto de Pregação';
    private const COMMUNITY_LABEL = 'Comunidade';
    private const PARISH_LABEL = 'Paróquia';

    case PREACHINGPOINT = 'ponto de pregação';
    case COMMUNITY = 'comunidade';
    case PARISH = 'paróquia';

    public static function getValues(): array
    {
        return array_map(fn(self $case) => $case->value, self::cases());
    }

    public function value():string
    {
        return match ($this) {
            self::PREACHINGPOINT => self::PREACHINGPOINT_LABEL,
            self::COMMUNITY => self::COMMUNITY_LABEL,
            self::PARISH => self::PARISH_LABEL,
        };
    }

    public static function getLabels(): array
    {
        return [
            self::PREACHINGPOINT->value => self::PREACHINGPOINT_LABEL,
            self::COMMUNITY->value => self::COMMUNITY_LABEL,
            self::PARISH->value => self::PARISH_LABEL,
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::PREACHINGPOINT => self::PREACHINGPOINT_LABEL,
            self::COMMUNITY => self::COMMUNITY_LABEL,
            self::PARISH => self::PARISH_LABEL,
        };
    }
}
