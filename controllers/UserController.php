<?php


namespace app\controllers;


use app\base\App;
use app\models\CartModel;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\UserRepository;
use app\models\User;
use app\models\UserModel;

class UserController extends Controller
{

    public function actionIndex()
    {
        $session = App::call()->session;
        $request = App::call()->request;
        $user_id = $session->get('user_id');
        $model = [];

        if ($request->getRequestType() == 'post') {

            // Если пришел запрос на удаление заказа
            if ($orderID = $request->post('id')) {
                // Помечаем заказ в базе как удаленный.
                (new OrderRepository())->deleteOrder($orderID);
                // Отправляем обратно, какой заказ надо отобразить как удаленный без перезагрузки страницы.
                $markOrder = '#orderStatusID' . $orderID;
                echo json_encode(['success' => 'ok', 'markOrder' => $markOrder]);
                exit;
            }

            $fio = $request->post('fio');
            $address = $request->post('address');
            $phone = $request->post('phone');
            if ($fio && $address && $phone) {
                (new CartModel())->createOrder($user_id, $fio, $address, $phone);

                App::call()->request->redirect('user');

            } else {
                $model['message'] = 'Вы что-то забыли ввести...';
            }
        }

        // Проверяем что юзер залогинен, если в сессии есть айди. Если нет, то перенаправляем на авторизацию.
        if ($user_id) {
            // Получаем данные пользователя из базы.
            $user = (new UserRepository())->getOne($user_id);

            // Если учетка юзера была создана автоматически, то перенаправляем на регистрацию, чтобы доавил данные.
            if ($user->name != 'Гость') {
                // Формируем список заказов.
                $model['orders'] = (new UserModel())->buildOrdersList($user_id);
            } else {
                App::call()->request->redirect('user/login');
            }
        } else {
            App::call()->request->redirect('user/login');
        }

        $model['user'] = $user;
        // Если корзина не пуста, то делаем форму для нового заказа.
        $model['cart'] = (new CartModel())->buildCart($user->id);

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
                    App::call()->request->redirect('index');
                }
                $model['message'] = "Неправильный логин или пароль!";
            }

            if ($request->post('button') == 'Зарегистрироваться') {
                $user = new User();
                $user->id = $session->get('user_id');
                $user->name = $request->post('name');
                $user->login = $request->post('login');
                $user->password = $request->post('password');
                if ($user->name && $user->login && $user->password) {
                    // Если юзер был зарегистрирован в качестве гостя, то его данные обновятся в бд под его id,
                    // если нет, то создастся новая запись в бд.
                    $returnedID = (new UserRepository())->save($user);
                    // Если пользователь создавался, то вернется сгенерированный id, если обновлялся, то вернется null
                    if ($returnedID) {
                        // Если пользователь создавался, то сохраняем в сессию его айди,
                        // чтобы не выкидывало из личного кабинета.
                        $session->set('user_id', $returnedID);
                    }
                    App::call()->request->redirect('index');
                } else {
                    // Если какое-то поле не ввели, то выводим сообщение
                    $model['message'] = "Вы что-то забыли ввести...";
                }
            }
        }
        echo $this->render("login", ['model' => $model]);
    }

}

