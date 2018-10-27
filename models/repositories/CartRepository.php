<?php


namespace app\models\repositories;


use app\controllers\ProductController;
use app\models\Cart;
use app\models\User;
use app\services\Request;

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

    public function addProductToCart($product, $quantity)
    {
        $cart = new Cart();

        $cart->product_id = $product->id;
        $cart->quantity = $quantity;
        $cart->sum = $product->price * $quantity;

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

        (new Request())->redirect($_SERVER['REQUEST_URI']);

    }

    public function getCart($user_id) {

        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE user_id = :id";


            return static::getDb()->executeQueryObjects($sql, $this->getEntityClass(), [':id' => $user_id]);


    }
}