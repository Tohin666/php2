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


    // Заглушка
    public function getCategoriesWithDiscount()
    {

    }
}