<?php

namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $photo;
    public $category_id;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'products';
    }

    // Заглушка
    public function getProductsByCategoryID($id)
    {

    }

    // Заглушка
    public function getProductsWithDiscount()
    {

    }
}