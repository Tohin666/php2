<?php


namespace app\services\renderers;


class TwigRenderer implements IRenderer
{
    private $twig;

    // При вызове метода рендер создается класс твига. Это для того чтобы класс создался один раз и не создавался
    // каждый раз при вызове метода.
    public function __construct()
    {
        // Twig
        $loader = new \Twig_Loader_Filesystem(TEMPLATES_DIR . 'twig');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => '/views/twig/compilation_cache',
        ));
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