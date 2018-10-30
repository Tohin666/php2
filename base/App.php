<?php

namespace app\base;


use app\traits\TSingleton;

/**
 * Class App
 * @package app\base
 * @property $db;
 * @property $request
 * @property $session
 */
class App
{
    use TSingleton;

    // Тоже самое что и вызывать через getInstance, только покороче.
    public static function call()
    {
        return static::getInstance();
    }

    public $config; // передается из индекса

    private $components; // new Storage()

    public function run($config) // запускается из индекса
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    // перенесли из индекса
    private function runController()
    {
//        $request = new \app\services\Request();

        // request не находит в данном классе и срабатывает магический метод гет ниже

        // Получаем параметры из гет. Если параметры не переданы, то подставляем контроллер по умолчанию (product)
        $controllerName = $this->request->getControllerName() ?: $this->config['defaultController'];
        $actionName = $this->request->getActionName(); // Действие по умолчанию задается в контроллере.
        // Получаем полное имя контроллера с неймспейсом.
        $controllerClass = $this->config['controllerNamespace'] . "\\" . ucfirst($controllerName) . "Controller";

        // Если такой класс существует, то создаем его объект и запускаем там метод run, куда передаем действие.
        if (class_exists($controllerClass)) {
            // при создании объекта передаем рендерер (шаблонизатор) при помощи которого будем отрисовывать.
            $controller = new $controllerClass(
                new \app\services\renderers\TemplateRenderer()
            //        new \app\services\renderers\TwigRenderer()
            );
            try {
                $controller->run($actionName);
            } catch (\Exception $e) {
// TODO ран контроллер 404
            }
        } else {
            echo "404";
        }
    }

    // метод получает название класса и создает его из конфига
    public function createComponent($key)
    {
        if (isset($this->config['components'][$key])) {
            $params = $this->config['components'][$key];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                // Класс ReflectionClass сообщает информацию о классе, имя которого передается в параметре.
                $reflection = new \ReflectionClass($class);
                // Создаёт экземпляр того класса с переданными параметрами (параметры передаются в конструктор)
                return $reflection->newInstanceArgs($params);
            } else {
                throw new \Exception("Не определен класс компонентта!");
            }
        } else {
            throw new \Exception("Компонент {$key} не найден!");
        }

    }

    // когда кто-то запрашивает экземпляр класса, то магический метод передает имя класса в метод гет класса Storage,
    // а тот возвращает объект, если он сущетвует, либо создает его при помощи метода createComponent выше и возвращает.
    function __get($name)
    {
        return $this->components->get($name);
    }
}