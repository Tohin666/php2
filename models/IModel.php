<?php

namespace app\models;

interface IModel
{
    public function create();

    public function getOne($id);

    public function getAll();

    public function update(int $id, array $val);

    public function delete(int $id);

    public function getTableName();

    public function getProperties();
}