<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case READER = 'reader';
    case USER = 'user';
    case ADMIN = 'admin';

    // Método para obter os valores
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getLabels(): array
    {
        return [
            self::READER->value => 'Leitor',
            self::USER->value => 'Usuário',
            self::ADMIN->value => 'Administrador',
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::READER => 'Leitor',
            self::USER => 'Usuário',
            self::ADMIN => 'Administrador',
        };
    }
}


