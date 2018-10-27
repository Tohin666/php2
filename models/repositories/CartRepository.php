<?php


namespace app\models\repositories;


use app\controllers\ProductController;
use app\models\Cart;
use app\models\User;

class CartRepository extends Repository
{
    public function getTableName()
    {
        return 'cart';
    }

    public function getEntityClass()
    {
        return Cart::class;
    }

    public function addProductToCart($product_id, $quantity)
    {
        $cart = new Cart();

        $cart->product_id = $product_id;
        $cart->quantity = $quantity;

        session_start();

        // Если юзер залогинен, или уже добавлял товар в корзину и временно создан как Гость, то берем его ИД.
        if ($_SESSION['user_id']) {
            $cart->user_id = $_SESSION['user_id'];

        // Если первый раз, то создаем временную учетку Гостя
        } else {
            $user = new User();
            $user->name = 'Гость';
            // при создании учетки в бд, получаем сгенерированный ИД.
            $cart->user_id = (new UserRepository())->save($user);
            // Сохраняем ИД только что созданного юзера Гостя в сессию, чтобы больше не создавался.
            $_SESSION['user_id'] = $cart->user_id;
        }

        $this->save($cart);
var_dump($_SERVER);
//        (new ProductController())->actionCard();

    }
}