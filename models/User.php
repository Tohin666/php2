<?php

namespace app\models;


class User extends Model
{
    public $id;
    public $login;
    public $password;

    /**
     * @return string - Возвращает в класс Model название таблицы, в которую нужно делать запрос.
     */
    public function getTableName()
    {
        return 'users';
    }

    // Заглушка
    public function getUserByRole()
    {

    }

}