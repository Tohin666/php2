<?php

namespace app\models;

class Order extends Model
{
    public $id;
    public $userId;
    public $sum;
    public $status;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'orders';
    }

    // Заглушка
    public function getOrdersByUserId($id)
    {

    }
}