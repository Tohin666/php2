<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

// Подключаем класс Автолоадер.
include ROOT_DIR . 'services/Autoloader.php';

// Регистрирует автолоадеры, помещая их в стек. В качестве параметра передаем массив, где первым значением создаем и
// передаем экземпляр класса Автолоадер, а вторым имя метода этого класса, который запустится когда тригер сработает.
spl_autoload_register([new app\services\Autoloader(), 'loadClass']);


$product = new app\models\Product();

// Создание нового элемента БД.
$product->name = 'Новый продукт2';
$product->description = 'Это описание нового продукта2';
$product->price = 600;
$product->create();
//$product->save();

// Получение данных из БД.
var_dump($product->getOne(2));
var_dump($product->getAll());

// Изменение элемента БД.
//$product->update(15, ['price' => 1500]);

// Удаление элемента БД.
//$product->delete();

//$order = new app\models\Order();
// Создание нового заказа.
//$order->user_id = 2;
//$order->sum = 800;
//$order->status = 'new';
//$order->id = $order->create();
//var_dump($order->getAll());

//$orderListProduct = new app\models\OrderList();
// Добавление товаров в заказ.
//$orderListProduct->order_id = 29;
//$orderListProduct->product_id = 2;
//$orderListProduct->quantity = 10;
//$orderListProduct->sum = 850;
//$orderListProduct->create();
//var_dump($orderListProduct->getAll());

//$category = new app\models\Category();
//// Создание новой категории.
//$category->name = 'Новая категория';
//$category->id = $category->create();
//var_dump($category->getAll(), $category->id);

//$user = new app\models\User();
//var_dump($user);

