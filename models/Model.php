<?php

namespace app\models;

use app\services\Db;

abstract class Model implements IModel
{
    private $db;

    /**
     * Model constructor. При создании экземпляра класса Model копирует экземпляр класса Db в свойство $db
//     * @param \app\services\IDb $db - Экземпляр класса Db который содержит методы для работы с базой данных. Должен
     * содержать в себе реализацию интерфейса IDb.
     */
    public function __construct()
//    public function __construct(\app\services\IDb $db)
    {
        // Метод паттерна TSingleton проверяет не создан ли уже экземпляр Db и создает его либо просто возвращает.
        $this->db = Db::getInstance();
//        $this->db = new Db();
//        $this->db = $db;
    }

    /**
     * Метод создает элемент в БД.
     */
    public function create()
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();
        // Реализация метода находится в дочерних классах, возвращает свойства объекта.
        $properties = $this->getProperties();
        // Оборачиваем значения массива в кавычки для передачи в БД в виде строк.
        foreach ($properties as $key => $val) {
            $properties[$key] = '"' . $val . '"';
        }
        // Извлекаем ключи в строку.
        $keys = implode(', ', array_keys($properties));
        // Извлекаем значения в строку.
        $values = implode(', ', array_values($properties));
        // Формируем запрос в БД
        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$values})";
        // Реализует в классе Db подключение к БД и возвращает массив значений одной строки.
        return $this->db->executeQuery($sql, [':id' => $id]);
    }

    /**
     * Метод возвращает одну строку из БД.
     * @param $id - ИД необходимого элемента.
     * @return array
     */
    public function getOne($id)
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";
        // Реализует в классе Db подключение к БД и возвращает массив значений одной строки.
        return $this->db->executeQueryOne($sql, [':id' => $id]);
    }

    public function getAll()
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table}";
        // Реализует в классе Db подключение к БД и возвращает массив таблицы.
        return $this->db->executeQueryAll($sql);
    }

}