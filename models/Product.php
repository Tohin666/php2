<?php
namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'products';
    }

    /**
     * @return array - Возвращает в класс Model свойства объекта.
     */
    public function getProperties()
    {
        $propertiesArray = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
        ];
        return $propertiesArray;
    }

    // Заглушка
    public function getProductsWithDiscount()
    {

    }
}