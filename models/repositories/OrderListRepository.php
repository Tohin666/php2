<?php


namespace app\models\repositories;


use app\models\OrderList;

class OrderListRepository extends Repository
{
    public function getTableName()
    {
        return 'order_list';
    }

    public function getEntityClass()
    {
        return OrderList::class;
    }

    public function getProductsFromOrder($order_id) {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE order_id = :id";


        return static::getDb()->executeQueryObjects($sql, $this->getEntityClass(), [':id' => $order_id]);
    }
}