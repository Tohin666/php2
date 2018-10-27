<?php

namespace app\models;

class Order extends DataEntity
{
    public $id;
    public $user_id;
    public $fio;
    public $address;
    public $phone;
    public $status;
    public $sum;


}