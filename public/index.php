<?php
include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

// Подключаем класс Автолоадер.
include ROOT_DIR . 'services/Autoloader.php';

// Регистрирует автолоадеры, помещая их в стек. В качестве параметра передаем массив, где первым значением создаем и
// передаем экземпляр класса Автолоадер, а вторым имя метода этого класса, который запустится когда тригер сработает.
spl_autoload_register([new app\services\Autoloader(), 'loadClass']);

// Получаем параметры из гет. Если параметры не переданы, то подставляем контроллер по умолчанию (product)
$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a']; // Действие по умолчанию задается в контроллере.

// Получаем полное имя контроллера с неймспейсом.
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

// Если такой класс существует, то создаем его объект и запускаем там метод run, куда передаем действие.
if (class_exists($controllerClass)) {
    // при создании объекта передаем рендерер (шаблонизатор) при помощи которого будем отрисовывать.
    $controller = new $controllerClass(
        new \app\services\renderers\TemplateRenderer()
    );
    $controller->run($actionName);
}


//$product = new app\models\Product();
//$product = app\models\Product::getAll();
//$product = app\models\Product::getOne(6);

// Добавление нового элемента в БД или изменение.
//$product->name = 'Новый продукт6';
//$product->description = 'Это описание нового продукта6';
//$product->price = 2200;
//$product->save();

// Удаление элемента БД.
//$product->delete();
