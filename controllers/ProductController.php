<?php


namespace app\controllers;


use app\models\Product;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        $model = (new ProductRepository())->getAll(); //Product::getAll();
        echo $this->render("catalog", ['model' => $model]);

    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $model = (new ProductRepository())->getOne($id); //Product::getOne($id);
        echo $this->render("card", ['model' => $model]);
    }



}