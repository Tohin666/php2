<?php

namespace app\models;

class Order extends Model
{
    public $id;
    public $user_id;
    public $sum;
    public $status;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'orders';
    }

    /**
     * @return array - Возвращает в класс Model свойства объекта.
     */
    public function getProperties()
    {
        $propertiesArray = [
            'user_id' => $this->user_id,
            'sum' => $this->sum,
            'status' => $this->status,
        ];
        return $propertiesArray;
    }

    // Заглушка
    public function getOrdersByUserId($user_id)
    {

    }
}