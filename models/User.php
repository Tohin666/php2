<?php

namespace app\models;


class User extends DataModel
{
    public $id;
    public $login;
    public $password;

    /**
     * @return string - Возвращает в класс DataModel название таблицы, в которую нужно делать запрос.
     */
    public static function getTableName()
    {
        return 'users';
    }

    // Заглушка
    public function getUserByRole()
    {

    }

}