<?php

namespace app\models;

class OrderList extends DataModel
{
    public $order_id;
    public $product_id;
    public $quantity;
    public $sum;

    /**
     * @return string - Возвращает в класс DataModel название таблицы, в которую нужно делать запрос.
     */
    public static function getTableName()
    {
        return 'order_list';
    }

}