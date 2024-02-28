<?php

namespace Core;

use PDO;
trait QueryMethodsTrait
{
    static public function getAll(): array
    {
        self::setTableName();

        $query = "SELECT * FROM " . static::$tableName . " ";

        return db()->query($query)->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    static public function find(int $id): static|false
    {
        self::setTableName();

        $query = db()->prepare("SELECT * FROM " . static::$tableName . " WHERE id = :id");
        $query->bindParam('id', $id);
        $query->execute();

        return $query->fetchObject(static::class);
    }

    static public function findBy(string $column, mixed $value): static|false
    {
        self::setTableName();

        $query = db()->prepare("SELECT * FROM " . static::$tableName . " WHERE $column = :$column");
        $query->bindParam($column, $value);
        $query->execute();

        return $query->fetchObject(static::class);
    }

    static public function create(array $fields): null|static
    {
        self::setTableName();

        $params = static::prepareQueryParams($fields);
        $query = db()->prepare("INSERT INTO " . static::$tableName . " ($params[keys]) VALUES ($params[placeholders])");

        if (!$query->execute($fields)) {
            return null;
        }

        return static::find(db()->lastInsertId());
    }

    public function update(array $fields): static
    {
        self::setTableName();

        $query = "UPDATE " . static::$tableName . " SET " . $this->updatePlaceholders(array_keys($fields)) . " WHERE id=:id";
        $query = db()->prepare($query);

        $fields['id'] = $this->id;
        $query->execute($fields);

        return static::find($this->id);
    }

    protected function updatePlaceholders(array $keys): string
    {

    }

    static protected function prepareQueryParams(array $fields): array
    {
        $keys = array_keys($fields);
        $placeholder = preg_filter('/^/', ':', $keys);

        return [
            'keys' => implode(', ', $keys),
            'placeholders' => implode(', ', $placeholder)
        ];
    }
}