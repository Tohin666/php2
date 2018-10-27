<?php


namespace app\services;


class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;
    // Тип запроса - гет или пост.
    private $requestType;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        try {
            $this->parseRequest();
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
//        finally {echo "этот текст выводится в любом случае";}
    }

///product/card?id=1
    public function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        // preg_match_all — Выполняет глобальный поиск шаблона в строке
        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
            if (!empty($_GET)) {
                $this->params['get'] = $_GET;
                $this->requestType = 'get';
            }
            if (!empty($_POST)) {
                $this->params['post'] = $_POST;
                $this->requestType = 'post';
            }

        } else {
            throw new \Exception("Неправильный запрос");
        }

    }


    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function get($name)
    {
        if (isset($this->params['get'][$name])) {
            return $this->params['get'][$name];
        }
        return null;
    }

    public function post($name)
    {
        if (isset($this->params['post'][$name])) {
            return $this->params['post'][$name];
        }
        return null;
    }

    // Метода возвращает типа запроса - гет или пост.
    public function getRequestType()
    {
        return $this->requestType;
    }
}