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

    // Заглушка
    public function getCategoriesWithDiscount()
    {

    }
}