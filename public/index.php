<?php

$config = include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

// Подключаем автолоадер композера.
require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

// Данный автолоадер больше не используем, теперь используем автолоадер композера.
//// Подключаем класс Автолоадер.
//include ROOT_DIR . 'services/Autoloader.php';
//
//// Регистрирует автолоадеры, помещая их в стек. В качестве параметра передаем массив, где первым значением создаем и
//// передаем экземпляр класса Автолоадер, а вторым имя метода этого класса, который запустится когда тригер сработает.
//spl_autoload_register([new app\services\Autoloader(), 'loadClass']);


\app\base\App::call()->run($config);




//$product = new app\models\Product();
//$product = (new app\models\repositories\ProductRepository())->getAll();
//$product = (new app\models\repositories\ProductRepository())->getOne(6);

// Добавление нового элемента в БД или изменение.
//$product->name = 'Новый продукт16';
//$product->description = 'Это описание нового продукта16';
//$product->price = 2036;
//(new \app\models\repositories\ProductRepository())->save($product);

// Удаление элемента БД.
//(new \app\models\repositories\ProductRepository())->delete($product);
