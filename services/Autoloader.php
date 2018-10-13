<?php
namespace app\services;

class Autoloader
{


//    private $dirs = [
//        'models',
//        'services'
//    ];
//
//    public function loadClass($className)
//    {
//        foreach ($this->dirs as $dir){
//            $filename = $_SERVER['DOCUMENT_ROOT'] . "/../{$dir}/{$className}.php";
//            if(file_exists($filename)){
//                include $filename;
//                break;
//            }
//        }
//    }

    public function loadClass($className)
    {
        $filename = str_replace('app', $_SERVER['DOCUMENT_ROOT'] . "\..", $className) . '.php';
        include $filename;

    }

}