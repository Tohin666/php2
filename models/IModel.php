<?php

namespace app\models;

interface IModel
{
    public function save();

    public static function getOne(int $id, string $objectOrArray = 'object');

    public static function getAll(string $objectOrArray = 'object');

//    public function update();

    public function delete();

    public static function getTableName();

}