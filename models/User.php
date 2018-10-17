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

    /**
     * @return array - Возвращает в класс Model свойства объекта.
     */
    public function getProperties()
    {
        $propertiesArray = [
            'id' => $this->id,
            'login' => $this->login,
            'password' => $this->password,
        ];
        return $propertiesArray;
    }

    // Заглушка
    public function getUserByRole()
    {

    }

}