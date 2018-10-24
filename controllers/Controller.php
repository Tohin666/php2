<?php
namespace app\controllers;


use app\services\renderers\IRenderer;
use app\services\renderers\TemplateRenderer;

abstract class Controller
{

    private $action;
    // Задаем действие по умолчанию.
    private $defaultAction = 'index';
    private $layout = "main";
    private $useLayout = true;

    // В это свойство мы будем запоминать экземпляр рендера
    private $renderer = null;

    /**
     * Controller constructor.
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * Метод определяет какое действие запустить в текущем контроллере.
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

    /**
     * Метод вызывает renderTemplate для отрисовки шаблона с лейаутом или без.
     * @param $template
     * @param array $params
     * @return mixed
     */
    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            // Если нужен лейаут, тогда сначала отрисовываем шаблон страницы
            $content = $this->renderTemplate($template, $params);
            // затем вставляем его в лейаут.
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        }
        // или просто возвращаем шаблон страницы.
        return $this->renderTemplate($template, $params);
    }

    /**
     * Данный метод вызывает метод render того рендерера (шаблонизатора), который был передан.
     * @param $template
     * @param array $params
     * @return mixed
     */
    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }


}