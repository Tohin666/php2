<?php

namespace app\controllers;


use app\base\App;
use app\models\CartModel;
use app\models\repositories\CartRepository;

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

            // При нажатии Заказать теперь просто перенаправляем в личный кабинет для оформления заказа, а там уже при
            // нажатии Заказать оформляется заказ в БД и очищается корзина.
            if ($request->get('button') == 'Заказать') {
                $request->redirect('user');
            }

            if ($request->get('button') == 'Удалить') {
                (new CartRepository())->deleteProductFromCart($user_id, $request->get('id'));
                $request->redirect('cart');
            }
        }

        $model = [];
        if ($user_id) {
            $model = (new CartModel)->buildCart($user_id);
        }

        echo $this->render("cart", ['model' => $model]);
    }

}