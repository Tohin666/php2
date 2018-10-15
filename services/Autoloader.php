<?php
namespace app\services;

class Autoloader
{

// старый автозагрузчик.
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

    // Данный метод сработает когда нужно будет подгрузить класс, в качестве параметра автоматически подставляется имя
    // этого класса.
    public function loadClass($className)
    {
        // Т.к. имя класса содержит namespace, то преобразуем его в полный путь до файла класса.
        $filename = str_replace(['app\\', '\\'], [ROOT_DIR, '/'], $className) . '.php';
        // и подключаем этот файл класса.
        if (file_exists($filename)) {
            include $filename;
        }


    }

}