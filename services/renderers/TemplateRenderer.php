<?php


namespace app\services\renderers;


use app\base\App;

class TemplateRenderer implements IRenderer
{
    public function render($template, $params = [])
    {
        ob_start();
        extract($params);
        include App::call()->config['templatesDir'] . $template . ".php";
        return ob_get_clean();
    }
}