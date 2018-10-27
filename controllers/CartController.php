<?php


namespace app\controllers;


use app\models\Cart;
use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;

class CartController extends Controller
{

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        session_start();

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