<?php

namespace app\models;


class User extends DataEntity
{
    public $id;
    public $login;
    public $password;

    /**
     * @return string - Возвращает в класс DataEntity название таблицы, в которую нужно делать запрос.
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