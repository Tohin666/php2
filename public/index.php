<?php
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


// Twig
$loader = new Twig_Loader_Filesystem(TEMPLATES_DIR . 'twig');
$twig = new Twig_Environment($loader, array(
    'cache' => '/views/twig/compilation_cache',
));


// Получаем параметры из гет. Если параметры не переданы, то подставляем контроллер по умолчанию (product)
$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a']; // Действие по умолчанию задается в контроллере.

// Получаем полное имя контроллера с неймспейсом.
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

// Если такой класс существует, то создаем его объект и запускаем там метод run, куда передаем действие.
if (class_exists($controllerClass)) {
    // при создании объекта передаем рендерер (шаблонизатор) при помощи которого будем отрисовывать.
    $controller = new $controllerClass(
//        new \app\services\renderers\TemplateRenderer()
        new \app\services\renderers\TwigRenderer($twig)
    );
    $controller->run($actionName);
}



//$product = new app\models\Product();
//$product = app\models\Product::getAll();
//$product = app\models\Product::getOne(6);

// Добавление нового элемента в БД или изменение.
//$product->name = 'Новый продукт6';
//$product->description = 'Это описание нового продукта8';
//$product->price = 2200;
//$product->save();

// Удаление элемента БД.
//$product->delete();
