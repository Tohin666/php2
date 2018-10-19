<?php

namespace app\models;

interface IModel
{
    public function create();
//    public function save();

    public function getOne($id);

    public function getAll();

    public function update();

    public function delete();

    public function getTableName();

}