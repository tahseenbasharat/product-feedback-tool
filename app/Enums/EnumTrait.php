<?php

namespace App\Enums;

trait EnumTrait
{
    public static function array(): array
    {
        return array_column(self::cases(), 'value');
    }
}
