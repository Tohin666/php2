<?php

namespace app\models;

class Product extends DataEntity
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $photo;
    public $category_id;

    public function getShortDescription()
    {
        return mb_substr($this->description, 0, 35);
    }


}