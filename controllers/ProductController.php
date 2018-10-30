<?php


namespace app\controllers;


use app\base\App;
use app\models\repositories\CartRepository;
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
        $request = App::call()->request;

        if ($request->getRequestType() == 'get') {
            $id = $request->get('id');
            $model = (new ProductRepository())->getOne($id); //Product::getOne($id);
            if ($request->get('message')) {
                $model->addToCartMessage = $request->get('message');
            }
            echo $this->render("card", ['model' => $model]);
        }

        if ($request->getRequestType() == 'post') {
            $product = (new ProductRepository())->getOne($request->post('id'));
            (new CartRepository())->addProductToCart($product, $request->post('quantity'));

        }
    }

}