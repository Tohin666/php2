<?php


namespace app\controllers;


use app\models\UserModel;
use app\services\Session;

class UserController extends Controller
{

    public function actionIndex()
    {
        $session = Session::getInstance();
        $user_id = $session->get('user_id');

        $model = [];
        if ($user_id) {
            $model = (new UserModel())->buildOrdersList($user_id);
        }

        echo $this->render("user", ['model' => $model]);
    }

}