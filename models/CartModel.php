<?php


namespace app\models;


use app\models\repositories\CartRepository;
use app\models\repositories\OrderListRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;

class CartModel
{
    public function buildCart($user_id)
    {
        $model = (new CartRepository())->getCart($user_id);
        // Если корзина не пуста, то формируем ее. Иначе возвращаем пустой массив.
        if ($model){
            $idsArray = [];
            foreach ($model as $product) {
                $idsArray[] = $product->product_id;
            }

            $getProducts = (new ProductRepository())->getSome($idsArray);

            $sum = null;
            foreach ($model as $index => $product) {
                $model[$index]->name = $getProducts[$index]->name;
                $model[$index]->price = $getProducts[$index]->price;
                $sum += $product->sum;
            }
            // Добавляем общую сумму корзины в нулевой индекс массива.
            array_unshift($model, $sum);
        }

        return $model;
    }

    public function createOrder($user_id)
    {
        $cart = (new CartRepository())->getCart($user_id);

        $order = new Order();
        $order->user_id = $cart[0]->user_id;
        $order->status = 'новый';

        $sum = null;
        foreach ($cart as $product) {
            $sum += $product->sum;
        }
        $order->sum = $sum;

        $order->id = (new OrderRepository())->save($order);

        foreach ($cart as $product) {
            $order_list_product = new OrderList();
            $order_list_product->order_id = $order->id;
            $order_list_product->product_id = $product->product_id;
            $order_list_product->quantity = $product->quantity;
            $order_list_product->sum = $product->sum;
            (new OrderListRepository())->save($order_list_product);
        }

        // Очищаем корзину после создания заказа.
        (new CartRepository())->clearCart($order->user_id);
    }

}