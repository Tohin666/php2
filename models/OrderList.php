<?php

namespace app\models;

class OrderList extends Model
{
    public $order_id;
    public $product_id;
    public $quantity;
    public $sum;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'order_list';
    }

}