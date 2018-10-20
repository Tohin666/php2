<?php


namespace app\controllers;


use app\models\Cart;

class CartController
{
    private $action;
    // Задаем действие по умолчанию.
    private $defaultAction = 'index';
    private $layout = "main";
    private $useLayout = true;

    /**
     * Метод определяет какое действие запустить в данном контроллере.
     * @param string $action
     */
    public function run($action = null)
    {
        // Если действие не было передано, то подставляем действие по умолчанию.
        $this->action = $action ?: $this->defaultAction;
        // Собираем имя метода (действия), которое нужно запустить в этом контроллере.
        $method = "action" . ucfirst($this->action);
        // Если такой метод есть в данном классе (констроллере), то запускаем его.
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404"; // в противном случае выдаем ошибку.
        }

    }

    // Метод получает список товаров и передает в рендер для отображения каталога.
    public function actionIndex()
    {
        $model = []; // тут будет метод getCart
        echo $this->render("cart", ['model' => $model]);

    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        }
        return $this->renderTemplate($template, $params);
    }

    public function renderTemplate($template, $params = [])
    {
        ob_start();
        extract($params);
        include TEMPLATES_DIR . $template . ".php";
        return ob_get_clean();
    }


}