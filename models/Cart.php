<?php

namespace app\models;

class Cart extends Model
{
    public $user_id;
    public $products;
    public $coupon;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'cart';
    }

    /**
     * @return array - Возвращает в класс Model свойства объекта.
     */
    public function getProperties()
    {
        $propertiesArray = [
            'user_id' => $this->user_id,
            'products' => $this->products,
            'coupon' => $this->coupon
        ];
        return $propertiesArray;
    }

    // Заглушка
    public function addProductsToCart($userId, $products)
    {

    }
}