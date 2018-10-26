<?php

namespace app\models;

class Category extends DataEntity
{
    public $id;
    public $name;

    /**
     * @return string - Возвращает в класс DataEntity название таблицы, в которую нужно делать запрос.
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