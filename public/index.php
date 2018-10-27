<?php
// В задании со звездочкой можно сделать как в твигРендере.


// Конфиг теперь подгружается в автолоадере композера.
//include $_SERVER['DOCUMENT_ROOT'] . '/../config/main.php';

// Подключаем автолоадер композера.
require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';

// Данный автолоадер больше не используем, теперь используем автолоадер композера.
//// Подключаем класс Автолоадер.
//include ROOT_DIR . 'services/Autoloader.php';
//
//// Регистрирует автолоадеры, помещая их в стек. В качестве параметра передаем массив, где первым значением создаем и
//// передаем экземпляр класса Автолоадер, а вторым имя метода этого класса, который запустится когда тригер сработает.
//spl_autoload_register([new app\services\Autoloader(), 'loadClass']);


$request = new \app\services\Request();

// Получаем параметры из гет. Если параметры не переданы, то подставляем контроллер по умолчанию (product)
$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName(); // Действие по умолчанию задается в контроллере.

// Получаем полное имя контроллера с неймспейсом.
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

// Если такой класс существует, то создаем его объект и запускаем там метод run, куда передаем действие.
if (class_exists($controllerClass)) {
    // при создании объекта передаем рендерер (шаблонизатор) при помощи которого будем отрисовывать.
    $controller = new $controllerClass(
        new \app\services\renderers\TemplateRenderer()
//        new \app\services\renderers\TwigRenderer()
    );
    $controller->run($actionName);
}



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
