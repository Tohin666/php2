<?php


namespace app\controllers;


use app\models\Cart;
use app\models\Order;
use app\models\OrderList;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderListRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\services\Request;

class CartController extends Controller
{

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        session_start();

        $request = new Request();

        if ($request->getRequestType() == 'get') {

            if ($_GET['button'] == 'Заказать') {
                $cart = (new CartRepository())->getCart($_SESSION['user_id']);

                $order = new Order();
                $order->user_id = $cart[0]->user_id;
                $order->status = 'новый';

                $sum = null;
                foreach ($cart as $product) {
                    $sum += $product->sum;
                }
                $order->sum = $sum;

                try {
                    $order->id = (new OrderRepository())->save($order);

                    foreach ($cart as $product) {
                        $order_list_product = new OrderList();
                        $order_list_product->order_id = $order->id;
                        $order_list_product->product_id = $product->product_id;
                        $order_list_product->quantity = $product->quantity;
                        $order_list_product->sum = $product->sum;
                        (new OrderListRepository())->save($order_list_product);
                    }

                    (new CartRepository())->clearCart($order->user_id);

                    $request->redirect('user');

                } catch (\Exception $e) {
                    echo $e->getMessage();
                }

            }


        }


        $model = [];

        if ($_SESSION['user_id']) {
            $model = (new CartRepository())->getCart($_SESSION['user_id']);

            $sum = null;
            foreach ($model as $index => $product) {
                $getProduct = (new ProductRepository())->getOne($product->product_id);

                $model[$index]->name = $getProduct->name;
                $model[$index]->price = $getProduct->price;

                $sum += $product->sum;
            }
            array_unshift($model, $sum);

        }

        echo $this->render("cart", ['model' => $model]);

    }



}