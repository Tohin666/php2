<?php

namespace app\models;

class Category extends DataModel
{
    public $id;
    public $name;

    /**
     * @return string - Возвращает в класс DataModel название таблицы, в которую нужно делать запрос.
     */
    public static function getTableName()
    {
        return 'categories';
    }

    // Заглушка
    public function getCategoriesWithDiscount()
    {

    }
}