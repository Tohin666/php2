<?php


namespace app\controllers;


use app\base\App;
use app\models\repositories\UserRepository;
use app\models\UserModel;

class UserController extends Controller
{

    public function actionIndex()
    {
        $session = App::call()->session;
        $user_id = $session->get('user_id');
//        $user = (new UserRepository())->getOne($user_id);

        $model = [];
        if ($user_id) {
        // TODO if ($user_id && $user->name != 'Гость') {
            $model = (new UserModel())->buildOrdersList($user_id);
        } else {
            App::call()->request->redirect('user/login');
        }

        echo $this->render("user", ['model' => $model]);
    }

    public function actionLogin()
    {
        $session = App::call()->session;
        $request = App::call()->request;
        $model = [];

        if ($request->getRequestType() == 'post') {

            if ($request->post('button') == 'Войти') {
                $login = $request->post('login');
                $password = $request->post('password');

                if ($user = (new UserRepository())->getUserByLoginPass($login, $password)) {
                    $session->set('user_id', $user->id);
                    App::call()->request->redirect('user');
                }
                $model['message'] = "Неправильный логин или пароль!";
            }

            if ($request->post('button') == 'Зарегистрироваться') {

                // Если юзер был зарегистрирован в качестве гостя, то сохраняем данные в базу под его id
                if ($session->get('user_id')) {}
            }
        }


        echo $this->render("login", ['model' => $model]);
    }

}

