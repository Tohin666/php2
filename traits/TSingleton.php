<?php

namespace app\traits;

// Шаблон создает класс в единственном экземпляре.
trait TSingleton
{
    // Переменная хранит в себе экземпляр необходимого класса.
    private static $instance;

    // Закрываем функцию конструктора.
    private function __construct()
    {
    }

    // Защищаем от клонирования объекта.
    private function __clone()
    {
    }

    // Защищаем от создания через unserialize
    private function __wakeup()
    {
    }

    /**
     * Метод проверяет создан ли уже экземпляр класса, и возвращает его.
     * @return static
     */
    public static function getInstance()
    {
        // Если экземпляр класса еще не был создан (self::$instance == null), то создаем его, если же уже создан, то
        // просто возвращем его.
        if (is_null(static::$instance)) {
            static::$instance = new static(); // new self()
        }
        return static::$instance;
    }
}