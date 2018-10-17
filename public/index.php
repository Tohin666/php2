<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

// Подключаем класс Автолоадер.
include ROOT_DIR . 'services/Autoloader.php';

// Регистрирует автолоадеры, помещая их в стек. В качестве параметра передаем массив, где первым значением создаем и
// передаем экземпляр класса Автолоадер, а вторым имя метода этого класса, который запустится когда тригер сработает.
spl_autoload_register([new app\services\Autoloader(), 'loadClass']);


$product = new app\models\Product();

// Создание нового элемента БД.
//$product->name = 'Новый продукт2';
//$product->description = 'Это описание нового продукта2';
//$product->price = 600;
//$product->id = $product->create();

// Получение данных из БД.
//var_dump($product->getOne(2));
var_dump($product->getAll());

// Изменение элемента БД.
//$product->update(15, ['price' => 1500]);

// Удаление элемента БД.
//$product->delete(15);

//$user = new app\models\User();
//var_dump($user);

