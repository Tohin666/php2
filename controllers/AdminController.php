<?php

namespace app\controllers;


use app\base\App;
use app\models\Product;
use app\models\repositories\ProductRepository;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $request = App::call()->request;
        $files = App::call()->files;
        $message = '';

        if ($request->getRequestType() == 'post') {
            $name = $request->post('name');
            $description = $request->post('description');
            $price = $request->post('price');
            $category_id = $request->post('category_id');
            $photo = $files->uploadFile(App::call()->config['publicDir'] . 'img/', 'loadedImage');

            if ($name && $description && $price && $category_id && $photo) {
                $product = new Product();
                $product->name = $name;
                $product->description = $description;
                $product->price = $price;
                $product->category_id = $category_id;
                $product->photo = $photo;

                (new ProductRepository())->save($product);
                App::call()->request->redirect('admin');

            } else {
                $message = 'Вы что-то забыли ввести...';
            }
        }

        if ($request->getRequestType() == 'get') {
            $deleteProduct = (new ProductRepository())->getOne($request->get('id'));
            (new ProductRepository())->delete($deleteProduct);
            App::call()->request->redirect('admin');
        }

        $model = (new ProductRepository())->getAll();

        echo $this->render("admin", ['model' => $model, 'message' => $message]);
    }

}