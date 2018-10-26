<?php

namespace app\models;

class Cart extends DataEntity
{
    public $user_id;
    public $products;
    public $coupon;

    /**
     * @return string - Возвращает в класс DataEntity название таблицы, в которую нужно делать запрос.
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