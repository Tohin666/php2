<?php

namespace app\controllers;


use app\base\App;
use app\models\CartModel;
use app\services\Request;

class CartController extends Controller
{

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        $session = App::call()->session;
//        $session = Session::getInstance();
        $user_id = $session->get('user_id');
        $request = App::call()->request;
//        $request = new Request();

        if ($request->getRequestType() == 'get') {

            if ($request->get('button') == 'Заказать') {
                (new CartModel())->createOrder($user_id);
                $request->redirect('user');
            }
        }

        $model = [];
        if ($user_id) {
            $model = (new CartModel)->buildCart($user_id);
        }

        echo $this->render("cart", ['model' => $model]);
    }

}