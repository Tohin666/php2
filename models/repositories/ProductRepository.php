<?php


namespace app\models\repositories;


use app\models\Product;

class ProductRepository extends Repository
{
    public function getTableName()
    {
        return 'products';
    }

    public function getEntityClass()
    {
        return Product::class;
    }

    public function getProductsByCategoryID($category_id)
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE category_id = :id";

        return static::getDb()->executeQueryObjects($sql, $this->getEntityClass(), [':id' => $category_id]);
    }

    // Заглушка
    public function getProductsWithDiscount()
    {

    }
}