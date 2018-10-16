<?php
namespace app\services;

//class Db
class Db implements IDb
{
    // Заглушка
    public function queryOne(string $sql): array
    {
        return [];
    }

    // Заглушка.
    public function queryAll(string $sql): array
    {
        return [];
    }
}