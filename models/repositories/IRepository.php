<?php

namespace app\models\repositories;

use app\models\DataEntity;

interface IRepository
{
    public function save(DataEntity $entity);

    public function getOne(int $id, string $objectOrArray = 'object');

    public function getAll(string $objectOrArray = 'object');

//    public function update();

    public function delete(DataEntity $entity);

    public function getTableName();

    public function getEntityClass();

}