<?php


namespace app\controllers;


use app\models\repositories\CartRepository;
use app\models\repositories\ProductRepository;
use app\services\Request;

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
        $request = new Request();

        if ($request->getRequestType() == 'get') {
            $id = $request->get('id');
            $model = (new ProductRepository())->getOne($id); //Product::getOne($id);
            echo $this->render("card", ['model' => $model]);
        }

        if ($request->getRequestType() == 'post') {
            $product = (new ProductRepository())->getOne($request->post('id'));
            (new CartRepository())->addProductToCart($product, $request->post('quantity'));

        }
    }

}