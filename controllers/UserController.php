<?php


namespace app\controllers;


use app\models\repositories\OrderListRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;

class UserController extends Controller
{
    public function actionIndex(){

        $model = [];

        session_start();

        if ($_SESSION['user_id']) {
            $model = (new OrderRepository())->getOrdersByUserId($_SESSION['user_id']);

            foreach ($model as $index => $order) {
                $productsFromOrder = (new OrderListRepository())->getProductsFromOrder($model[$index]->id);

                foreach ($productsFromOrder as $productIndex => $productFromOrder) {
                    $product = (new ProductRepository())->getOne($productFromOrder->product_id);

                    $productsFromOrder[$productIndex]->name = $product->name;
                    $productsFromOrder[$productIndex]->price = $product->price;
                }

                $model[$index]->products = $productsFromOrder;

            }


        }

        echo $this->render("user", ['model' => $model]);

    }

}