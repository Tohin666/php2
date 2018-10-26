<?php

namespace app\models;

class Order extends DataEntity
{
    public $id;
    public $user_id;
    public $fio;
    public $address;
    public $phone;
    public $status;
    public $sum;

    /**
     * @return string - Возвращает в класс DataEntity название таблицы, в которую нужно делать запрос.
     */
    public static function getTableName()
    {
        return 'orders';
    }

    // Заглушка
    public function getOrdersByUserId($user_id)
    {

    }
}