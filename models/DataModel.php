<?php

namespace app\models;

use app\services\Db;

abstract class DataModel implements IModel
{
    private $db;

    /**
     * DataModel constructor. При создании экземпляра класса DataModel копирует экземпляр класса Db в свойство $db
     */
    public function __construct()
//    public function __construct(\app\services\IDb $db)
    {
        // Метод паттерна TSingleton проверяет не создан ли уже экземпляр Db и создает его либо просто возвращает.
        $this->db = Db::getInstance();
//        $this->db = new Db();
//        $this->db = $db;
    }

    /**
     * Метод создает новый элемент в БД, или изменяет если он уже существует.
     */
    public function save()
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();

        // Получаем инофрмацию о колонках таблицы в виде массива массивов.
        $sql = "SHOW COLUMNS FROM {$table}";
        $columns = $this->db->executeQueryAll($sql);

        // Получаем из этих массивов только наименования колонок.
        $columnsNames = [];
        foreach ($columns as $column) {
            $columnsNames[] = $column['Field'];
        }

        // Нам нужно выбрать только те свойства объекта которые есть в базе.
        // Перебираем свойства текущего объекта.
        $properties = [];
        foreach ($this as $key => $val) {
            // Если такое свойство присутствует в базе, то сохраняем в отдельный массив.
            if (in_array($key, $columnsNames)) {
                $properties[$key] = $val;
            }
        }

        // Если у объекта нет id, то значит это новый, только что созданный объект.
        // Тогда будем создавать новую строку в бд.
        if ($properties['id'] == null) {
            // Извлекаем ключи в строку для подстановки в sql-запрос.
            $keys = implode(', ', array_keys($properties));

            // Формируем массив с параметрами для подставления вместо паттернов.
            $params = [];
            foreach ($properties as $pattern => $val) {

//            // оборачиваем в кавычки если будет строка // не надо в кавычки оборачивать??
//            if (gettype($val) == 'string') {
//                $val = '"' . $val . '"';
//            }

                // Ключ будет паттерном, поэтому добавляем к нему двоеточие,
                // а значение будет подставляется вместо паттерна.
                $params[':' . $pattern] = $val;
            }

            // Формируем строку значений в виде паттернов для подстановки в sql-запрос.
            $values = implode(', ', array_keys($params));

            // Формируем запрос в БД
            $sql = "INSERT INTO {$table} ({$keys}) VALUES ({$values})";

            // Реализует в классе Db подключение к БД и возвращает ID.
            $this->db->executeQuery($sql, $params);
            $this->id = $this->db->returnLastInsertId();

            // Если объект уже существует, то изменяем соответствующую строку в бд.
        } else {
            // Нам нужно сравнить свойства объекта со значениями в базе, и перезаписать только те которые изменились.
            // Получаем значения текущего объетка из таблицы бд.
            $tableProperties = static::getOne(6, 'array');

            // Теперь надо сравнить значения из бд и текущие свойства.
            $newProperties = [];
            foreach ($properties as $key => $val) {
                // Если значения не совпадают, то добавляем новое значение в массив.
                if ($properties[$key] != $tableProperties[$key])
                    $newProperties[$key] = $val;
            }

            // Перебираем новые параметры. Формируем строку новых значений для подстановки в sql-запрос.
            $propertiesString = '';
            $params = [];
            $i = 0;
            foreach ($newProperties as $key => $val) {
                // Если значений несколько, до вставляем между ними запятую.
                if ($i != 0) {
                    $propertiesString .= ', ';
                }
                $keyPattern = ':' . $key;
                $propertiesString .= $key . ' = ' . $keyPattern;
                // Подготавливаем параметры для подстановки в паттерны.
                $params[$keyPattern] = $val;
                $i++;
            }


            // Формируем запрос в БД
            $sql = "UPDATE {$table} SET {$propertiesString} WHERE id = :id";

            // Добавляем id в паттерны.
            $params[':id'] = $this->id;

            // Реализует в классе Db подключение к БД.
            $this->db->executeQuery($sql, $params);
        }
    }

    /**
     * Метод возвращает одну строку из БД.
     * @param $id - ИД необходимого элемента.
     * @param string $objectOrArray - указывает в каком виде вернуть.
     * @return object|array
     */
    public static function getOne(int $id, string $objectOrArray = 'object')
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table} WHERE id = :id";

        // В зависимости от переданного параметра возвращает объект или массив.
        if ($objectOrArray == 'object') {
            // Реализует в классе Db подключение к БД и возвращает объект из значений одной строки.
            return Db::getInstance()->executeQueryObject($sql, get_called_class(), [':id' => $id]); //get_called_class подставляет
            // имя класса в контексте которого она вызвана

        } else {
            // Реализует в классе Db подключение к БД и возвращает массив строки таблицы.
            return Db::getInstance()->executeQueryOne($sql, [':id' => $id]);
//            return Db::getInstance()->executeQueryAll($sql);
        }

    }

    /**
     * Метод делает выборку из БД.
     * @param string $objectOrArray - указывает в каком виде вернуть.
     * @return object|array
     */
    public static function getAll(string $objectOrArray = 'object')
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = static::getTableName();
        $sql = "SELECT * FROM {$table}";

        // В зависимости от переданного параметра возвращает объект или массив.
        if ($objectOrArray == 'object') {
            // Реализует в классе Db подключение к БД и возвращает значения таблицы в виде объекта.
            return Db::getInstance()->executeQueryObjects($sql, get_called_class());
        } else {
            // Реализует в классе Db подключение к БД и возвращает массив таблицы.
            return Db::getInstance()->executeQueryAll($sql);
        }

    }

    /**
     * Метод удаляет текущий объект из БД.
     */
    public function delete()
    {
        // Реализация метода находится в дочерних классах, там подставляется название необходимой таблицы.
        $table = $this->getTableName();

        // Формируем запрос в БД
        $sql = "DELETE FROM {$table} WHERE id = :id";

        // Реализует в классе Db подключение к БД.
        $this->db->executeQuery($sql, [':id' => $this->id]);
    }

}