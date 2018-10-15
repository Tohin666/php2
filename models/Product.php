<?php
namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $producerId;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'products';
    }

    // Заглушка
    public function getProductsWithDiscount()
    {

    }
}