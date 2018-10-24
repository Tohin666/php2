<?php


namespace app\services\renderers;


class TwigRenderer implements IRenderer
{
    public $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }


    public function render($template, $params = [])
    {
        return $this->twig->render($template, $params);
    }

}