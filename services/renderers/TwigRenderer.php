<?php


namespace app\services\renderers;


class TwigRenderer implements IRenderer
{
    private $twig;

    // При создании объекта передается Twig_Environment
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    // Метод возвращает отрисованный шаблон.
    public function render($template, $params = [])
    {
        // Добавляем к имени шаблона расширение твиг.
        $template .= '.twig';
        // Запускаем метод render объекта twig (экземпляр класса Twig_Environment)
        return $this->twig->render($template, $params);
    }

}