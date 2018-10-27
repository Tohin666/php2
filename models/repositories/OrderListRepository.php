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


}