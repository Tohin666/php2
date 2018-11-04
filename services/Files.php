<?php

namespace app\services;


use app\base\App;

class Files
{

    public function uploadFile($uploadDir, $attributeName = 'file')
    {

        // Создаем директорию для загрузки, если ее не существует.
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir);
        }

        // Берем имя файла из атрибутов.
        $filename = basename($_FILES[$attributeName]['name']);
        // Отделяем расширение файла.
        $fileExtension = strrchr($filename, '.');
        // Отделяем имя файла от расширения.
        $filenameWithoutExtension =
            substr_replace($filename, '', -strlen($fileExtension), strlen($fileExtension));
        // Собираем полный путь к файлу.
        $filenameWithPath = $uploadDir . $filename;

        // Если файл с таким имененем уже существует, то добавляем к имени уникальный ID.
        if (file_exists($filenameWithPath)) {
            $filenameWithoutExtension .= uniqid();
            $filename = $filenameWithoutExtension . $fileExtension;
            $filenameWithPath = $uploadDir . $filename;
        }


        // Проверяем, является ли файл изображением, и он не более 3MB, и пробуем его переместить.
        if (substr($_FILES[$attributeName]['type'], 0, 5) == 'image' &&
            $_FILES[$attributeName]['size'] <= 3000000 &&
            move_uploaded_file($_FILES[$attributeName]['tmp_name'], $filenameWithPath)) {

            // Создаем папку для уменьшенных копий изображений, если ее не существует.
            $smallImageDir = App::call()->config['publicDir'] . 'img/small/';
            if (!file_exists($smallImageDir)) {
                mkdir($smallImageDir);
            }

            // Создаем полный путь до уменьшенного изображения.
            $smallFilenameWithPath = $smallImageDir . $filename;

            // Уменьшаем изображение.
            require App::call()->config['vendorDir'] . 'funcImgResize.php';

            img_resize($filenameWithPath, $smallFilenameWithPath, 200, 300);

        }

        return $filename;
    }
}