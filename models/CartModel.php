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
        if ($model) {
            // Получаем айдишники товаров в корзине.
            $idsArray = [];
            foreach ($model as $product) {
                $idsArray[] = $product->product_id;
            }

            // Получаем по этим айдишникам товары из базы.
            $getProducts = (new ProductRepository())->getSome($idsArray);

            $sum = null;
            // Перебираем корзину и товары полученные из базы. При совпадении айдишиков копируем имя и цену товара
            // к товару в корзине. Приходится перебирать оба массива и искать совпадение по айди, т.к. массив из базы
            // приходит перемешанными в другом порядке.
            foreach ($model as $modelIndex => $modelValue) {
                foreach ($getProducts as $getProductsIndex => $getProductsValue) {
                    if ($modelValue->product_id == $getProductsValue->id) {
                        $model[$modelIndex]->name = $getProducts[$getProductsIndex]->name;
                        $model[$modelIndex]->price = $getProducts[$getProductsIndex]->price;
                        // заодно считаем общую сумму.
                        $sum += $modelValue->sum;
                    }
                }
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