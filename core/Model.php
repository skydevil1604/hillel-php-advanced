<?php

namespace Core;

abstract class Model
{
    use QueryMethodsTrait;
    public int $id;
    static public string|null $tableName = null;

    static public function setTableName(): string
    {
        // Отримуємо ім'я класу
        $className = basename(str_replace('\\', '/', static::class));

        // Розбиваємо ім'я класу на окремі слова
        $words = preg_split('/(?=[A-Z])/', $className, -1, PREG_SPLIT_NO_EMPTY);

        // Перетворюємо слова в нижній регістр і об'єднуємо їх через підкреслення "_"
        $tableName = strtolower(implode('_', $words));

        // Додаємо "s" в кінці назви таблиці
        $tableName .= 's';

        return static::$tableName = $tableName;
    }

    public function toArray(): array
    {
        $data = [];

        $reflect = new \ReflectionClass($this);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC);
        $vars = (array) $this;

        foreach($props as $prop) {
            if (in_array($prop->getName(), ['tableName'])) {
                continue;
            }

            $data[$prop->getName()] = $vars[$prop->getName()] ?? null;
        }

        return $data;
    }
}