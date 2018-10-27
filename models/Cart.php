<?php

namespace app\models;

class Cart extends DataEntity
{
    public $user_id;
//    public $products;

    // ИД и количество последнего добавленного товара в корзину.
    public $product_id;
    public $quantity;
    public $sum; // цена $product_id * $quantity

    public $coupon;


}