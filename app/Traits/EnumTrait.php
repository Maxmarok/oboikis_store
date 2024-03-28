<?php

namespace App\Traits;

trait EnumTrait
{
    /**
     * Получить массив всех значений
     * @return array
     */
    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Получить массив значений по типу
     * @param array $cases Список ключей enum
     * @return array
     */
    public static function filter(array $cases): array 
    {
        return array_map(fn($enum) => $enum->value, $cases);
    }

    /**
     * Получить значение enum по имени
     * @param string $name Имя enum
     * @return string
     * @throws \ValueError
     */
    public static function value(string $name): string
    {
        foreach (self::cases() as $status) {
            if($name === $status->name){
                return $status->value;
            }
        }

        throw new \ValueError("$name is not a valid backing value for enum " . self::class);
    }
}