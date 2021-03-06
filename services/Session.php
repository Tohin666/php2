<?php

namespace app\services;


//use app\traits\TSingleton;

class Session
{

//    use TSingleton;


    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}