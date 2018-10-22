<?php


namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        $model = Product::getAll();
        echo $this->render("catalog", ['model' => $model]);

    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $model = Product::getOne($id);
        echo $this->render("card", ['model' => $model]);
    }



}