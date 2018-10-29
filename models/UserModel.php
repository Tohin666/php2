<?php

namespace app\models;


use app\models\repositories\OrderListRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;

class UserModel
{
    public function buildOrdersList($user_id)
    {
        $model = (new OrderRepository())->getOrdersByUserId($user_id);

        foreach ($model as $index => $order) {
            $productsFromOrder = (new OrderListRepository())->getProductsFromOrder($model[$index]->id);

            foreach ($productsFromOrder as $productIndex => $productFromOrder) {
                $product = (new ProductRepository())->getOne($productFromOrder->product_id);

                $productsFromOrder[$productIndex]->name = $product->name;
                $productsFromOrder[$productIndex]->price = $product->price;
            }

            $model[$index]->products = $productsFromOrder;
        }
        return $model;
    }

}