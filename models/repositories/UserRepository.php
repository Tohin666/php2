<?php


namespace app\models\repositories;


use app\models\User;

class UserRepository extends Repository
{
    public function getTableName()
    {
        return 'users';
    }

    public function getEntityClass()
    {
        return User::class;
    }

    public function getUserByLoginPass($login, $password)
    {
        $table = $this->getTableName();
        $sql = "SELECT * FROM {$table} WHERE login = :login AND password = :password";
        return static::getDb()->executeQueryObject($sql, $this->getEntityClass(),
            [':login' => $login, ':password' => $password]);
    }


    // Заглушка
    public function getUserByRole()
    {

    }
}