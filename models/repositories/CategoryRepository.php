<?php


namespace app\models\repositories;


use app\models\Category;

class CategoryRepository extends Repository
{
    public function getTableName()
    {
        return 'categories';
    }

    public function getEntityClass()
    {
        return Category::class;
    }

    public function getCategory($id)
    {
        return static::getOne($id);
    }

    // Заглушка
    public function getCategoriesWithDiscount()
    {

    }
}