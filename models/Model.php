<?php

namespace app\models;

use app\services\Db;

abstract class Model implements IModel
{
    private $db;

    /**
     * Model constructor. При создании экземпляра класса Model копирует экземпляр класса Db в свойство $db
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

        // Получаем наименование колонок таблицы.
        $sql = "SHOW COLUMNS FROM {$table}";
        $this->db->executeQuery($sql);
        var_dump($sql); exit;

        // Извлекаем ключи в строку для подстановки в sql-запрос.
        $keys = implode(', ', array_keys($properties));

        // Формируем массив с параметрами для подставления вместо паттернов.
        $params = [];
        foreach ($properties as $pattern => $val) {

//            // оборачиваем в кавычки если будет строка // не надо в кавычки оборачивать??
//            if (gettype($val) == 'string') {
//                $val = '"' . $val . '"';
//            }

            // Ключ будет паттерном, поэтому добавляем к нему двоеточие,
            // а значение будет подставляется вместо паттерна.
            $params[':' . $pattern] = $val;
        }

        // Формируем строку значений в виде паттернов для подстановки в sql-запрос.
        $values = implode(', ', array_keys($params));

        // Формируем запрос в БД
        $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$values})";

        // Реализует в классе Db подключение к БД и возвращает ID.
        $this->db->executeQuery($sql, $params);
        $this->id = $this->db->returnLastInsertId();
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

        // Реализует в классе Db подключение к БД и возвращает объект из значений одной строки.
        return $this->db->executeQueryObject($sql, get_called_class(), [':id' => $id]); //get_called_class подставляет
        // имя класса в контексте которого она вызвана

//        // Реализует в классе Db подключение к БД и возвращает массив значений одной строки.
//        return $this->db->executeQueryOne($sql, [':id' => $id]);
    }

    /**
     * Метод делает выборку из БД.
     * @return array
     */
    public function getAll()
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table}";
        // Реализует в классе Db подключение к БД и возвращает массив таблицы.
        return $this->db->executeQueryObjects($sql, get_called_class());
    }

    /**
     * Метод изменяет значение элемента в БД.
     * @param int $id
     * @param array $val
     */
    public function update()
//    public function update(int $id, array $val)
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();

        // Разбираем параметры.
        $key = key($val);
        $keyPattern = ':' . $key;
        $val = $val[$key];

        // Формируем запрос в БД
        $sql = "UPDATE {$table} SET {$key} = {$keyPattern} WHERE id = :id";

        // Подготавливаем параметры для подставки в паттерны.
        $params = [$keyPattern => $val, ':id' => $id];

        // Реализует в классе Db подключение к БД.
        $this->db->executeQuery($sql, $params);
    }

    public function delete()
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();

        // Формируем запрос в БД
        $sql = "DELETE FROM {$table} WHERE id = :id";

        // Реализует в классе Db подключение к БД.
        $this->db->executeQuery($sql, [':id' => $this->id]);
    }

}