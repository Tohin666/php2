<?php

namespace app\models;

class Cart extends DataModel
{
    public $user_id;
    public $products;
    public $coupon;

    /**
     * @return string - Возвращает в класс DataModel название таблицы, в которую нужно делать запрос.
     */
    public static function getTableName()
    {
        return 'cart';
    }

    // Заглушка
    public function addProductsToCart($userId, $products)
    {

    }
}