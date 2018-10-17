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

//    /**
//     * Метод записывает в базу товары относящиеся к заказу.
//     * @param int $order_id - ID заказа.
//     * @param array $products - Массив содержащий товары и их количество ['product_id' => 'quantity']
//     */
//    public function setProductsToOrderList(int $order_id, array $products)
//    {
//        foreach ($products as $key => $value) {
//            $params = [];
//            $params = ['order_id' => $order_id, 'product_id' => $key, 'quantity' => $value];
//            $this->create();
//        }
//    }


}