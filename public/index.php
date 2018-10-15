<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

// Подключаем класс Автолоадер.
include ROOT_DIR . 'services/Autoloader.php';

// Регистрирует автолоадеры, помещая их в стек. В качестве параметра передаем массив, где первым значением создаем и
// передаем экземпляр класса Автолоадер, а вторым имя метода этого класса, который запустится когда тригер сработает.
spl_autoload_register([new app\services\Autoloader(), 'loadClass']);
$db = new app\services\Db();

$product = new app\models\Product($db);
var_dump($product);

$user = new app\models\User($db);
var_dump($user);

