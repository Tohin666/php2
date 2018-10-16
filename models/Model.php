<?php

namespace app\models;

use app\services\Db;

abstract class Model implements IModel
{
    private $db;

    /**
     * Model constructor. При создании экземпляра класса Model копирует экземпляр класса Db в свойство $db
     * @param \app\services\IDb $db - Экземпляр класса Db который содержит методы для работы с базой данных. Должен
     * содержать в себе реализацию интерфейса IDb.
     */
    public function __construct()
//    public function __construct(\app\services\IDb $db)
    {
        $this->db = Db::getInstance();
//        $this->db = new Db();
//        $this->db = $db;
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