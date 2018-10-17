<?php

namespace app\models;

class Category extends Model
{
    public $id;
    public $name;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'categories';
    }

    /**
     * @return array - Возвращает в класс Model свойства объекта.
     */
    public function getProperties()
    {
        $propertiesArray = [
            'id' => $this->id,
            'name' => $this->name
        ];
        return $propertiesArray;
    }

    // Заглушка
    public function getCategoriesWithDiscount()
    {

    }
}