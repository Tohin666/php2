<?php
// ...
include $_SERVER['DOCUMENT_ROOT'] . "/../services/Autoloader.php";


spl_autoload_register([new app\services\Autoloader(), 'loadClass']);
$db = new app\services\Db();
$product = new app\models\Product($db);
var_dump($product);