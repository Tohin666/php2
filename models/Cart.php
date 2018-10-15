<?php

namespace app\models;

class Cart extends Model
{
    public $userId;
    public $products;
    public $coupon;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'cart';
    }

    // Заглушка
    public function addProductsToCart($userId, $products)
    {

    }
}