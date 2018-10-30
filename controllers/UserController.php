<?php


namespace app\controllers;


use app\base\App;
use app\models\UserModel;

class UserController extends Controller
{

    public function actionIndex()
    {
        $session = App::call()->session;
        $user_id = $session->get('user_id');

        $model = [];
        if ($user_id) {
            $model = (new UserModel())->buildOrdersList($user_id);
        }

        echo $this->render("user", ['model' => $model]);
    }

}