<?php


namespace app\models\repositories;


use app\base\App;
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

    public function addProductToCart($product, $quantity)
    {
        $cart = new Cart();

        $cart->product_id = $product->id;
        $cart->quantity = $quantity;
        $cart->sum = $product->price * $quantity;

        $session = App::call()->session;

        // Если юзер залогинен, или уже добавлял товар в корзину и временно создан как Гость, то берем его ИД.
        if ($session->get('user_id')) {
            $cart->user_id = $session->get('user_id');

            // Если первый раз, то создаем временную учетку Гостя
        } else {
            $user = new User();
            $user->name = 'Гость';
            // при создании учетки в бд, получаем сгенерированный ИД.
            $cart->user_id = (new UserRepository())->save($user);
            // Сохраняем ИД только что созданного юзера Гостя в сессию, чтобы больше не создавался.
            $session->set('user_id', $cart->user_id);
        }

        // Проверяем есть ли уже товар в корзине с таким product_id и user_id.
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE user_id = :user_id AND product_id = :product_id";
        $searchProductInDB = static::getDb()->executeQueryObject($sql, $this->getEntityClass(),
            [':user_id' => $cart->user_id, ':product_id' => $cart->product_id]);
        if ($searchProductInDB) {
            // Если товар уже есть в корзине, то прибавляем количество
            $totalQuantity = $cart->quantity + $searchProductInDB->quantity;
            // и сумму.
            $totalSum = $cart->sum + $searchProductInDB->sum;
            $sql =
                "UPDATE {$table} SET quantity = {$totalQuantity}, sum = {$totalSum} 
                 WHERE user_id = :user_id AND product_id = :product_id";
            static::getDb()->executeQuery($sql, [':user_id' => $cart->user_id, ':product_id' => $cart->product_id]);
        } else {
            // Если товара еще не было в корзине, то добавляем.
            $this->save($cart);
        }

        App::call()->request->redirect($_SERVER['REQUEST_URI'] . '&message=Товар добавлен в корзину');
    }

    public function deleteProductFromCart($user_id, $product_id)
    {
        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE user_id = :user_id AND product_id = :product_id";

        static::getDb()->executeQuery($sql, [':user_id' => $user_id, ':product_id' => $product_id]);
    }

    public function getCart($user_id)
    {

        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE user_id = :id";

        return static::getDb()->executeQueryObjects($sql, $this->getEntityClass(), [':id' => $user_id]);
    }

    public function clearCart($user_id)
    {

        $table = $this->getTableName();
        $sql = "DELETE FROM {$table} WHERE user_id = :id";

        static::getDb()->executeQuery($sql, [':id' => $user_id]);
    }
}