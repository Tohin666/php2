<?php


namespace app\controllers;


use app\base\App;
use app\models\ProductModel;
use app\models\repositories\CartRepository;
use app\models\repositories\CategoryRepository;
use app\models\repositories\ProductRepository;

class ProductController extends Controller
{

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        $products = (new ProductRepository())->getAll(); //Product::getAll();
        $model = (new ProductModel())->createShortDescriptions($products);
        echo $this->render("catalog", ['model' => $model]);

    }

    public function actionCategory()
    {
        $request = App::call()->request;

        if ($request->getRequestType() == 'get') {
            $id = $request->get('id');
            $products = (new ProductRepository())->getProductsByCategoryID($id);

            $category = (new CategoryRepository())->getCategory($id);

            $model = (new ProductModel())->createShortDescriptions($products);
            echo $this->render("category", ['model' => $model, 'category' => $category]);

        }
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
            $category = (new CategoryRepository())->getCategory($model->category_id);
            $model->category_name = $category->name;

            echo $this->render("card", ['model' => $model]);
        }

        if ($request->getRequestType() == 'post') {
            $product = (new ProductRepository())->getOne($request->post('id'));
            (new CartRepository())->addProductToCart($product, $request->post('quantity'));

        }
    }

}