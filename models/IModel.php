<?php
namespace app\models;

interface IModel
{
    public function create();
    public function getOne($id);
    public function getAll();
//    public function update($id, $val);
//    public function delete();
    public function getTableName();
    public function getProperties();
}