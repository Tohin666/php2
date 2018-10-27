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


    // Заглушка
    public function getUserByRole()
    {

    }
}