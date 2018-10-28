<?php


namespace app\models\repositories;


use app\models\Order;

class OrderRepository extends Repository
{
    public function getTableName()
    {
        return 'orders';
    }

    public function getEntityClass()
    {
        return Order::class;
    }



    public function getOrdersByUserId($user_id)
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE user_id = :id";


        return static::getDb()->executeQueryObjects($sql, $this->getEntityClass(), [':id' => $user_id]);

    }
}