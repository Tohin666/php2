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

    /**
     * @return array - Возвращает в класс Model свойства объекта.
     */
    public function getProperties()
    {
        $propertiesArray = [
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'sum' => $this->sum,
        ];
        return $propertiesArray;
    }

}