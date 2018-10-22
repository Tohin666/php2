<?php


namespace app\controllers;


use app\models\Cart;

class CartController extends Controller
{

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        $model = []; // тут будет метод getCart
        echo $this->render("cart", ['model' => $model]);

    }



}