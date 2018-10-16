<?php

namespace app\services;


use app\traits\TSingleton;

class Db
//class Db implements IDb
{
    use TSingleton;

    // Конфиг для PDO
    private $config = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '3307',
        'login' => 'root',
        'password' => '',
        'database' => 'myShopDB',
        'charset' => 'utf8'
    ];

    protected $connection = null;

    /**
     * Метод создает (если еще не создано) и возвращает соединение с БД.
     * @return null|\PDO - возвращает экземпляр класса PDO
     */
    protected function getConnection()
    {
        if (is_null($this->connection)) {
            // Создаем экземпляр класса PDO
            $this->connection = new \PDO(
            // Метод подготавливает строку с параметрами подлючения к БД для PDO
                $this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );

            // Задаем с помощью метода setAttribute класса PDO парметр чтобы получить ответ в виде ассоц. массива
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
//            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }

        return $this->connection;
    }

    // "SELECT * FROM products WHERE id = :id" - после двоеточия указывается именованный плейсхолдер, вмето которого
    // потом подставляется значение. Знак вопроса - неименованный плейсхолдер.


    /**
     * Метод отправляет запрос в БД
     * @param string $sql - Сам sql-запрос
     * @param array $params - параметр вида [':id' => 1]
     * @return \PDOStatement
     */
    private function query(string $sql, array $params = [])
    {
        // Метод prepare экземпляра класса PDO возвращает объект подготовленного запроса в БД:
        /** @var \PDOStatement $pdoStatement */
        // Подготавливаем запрос один раз, а выполняем несколько с помощью передаваемых параметров.
        $pdoStatement = $this->getConnection()->prepare($sql);

        // Если ошибка
        if (!$pdoStatement) {
            var_dump($this->getConnection()->errorInfo());
        }

        // Можно так передать параметр, но мы будем передавать параметр извне.
//        $id = 1;
//        $pdoStatement->bindParam(':id', $id, \PDO::PARAM_INT);

        // Метод execute полученного объекта выполняет запрос
        $pdoStatement->execute($params);
        return $pdoStatement;
    }

    /**
     * Метод возвращает одну строку из БД
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function executeQueryOne(string $sql, array $params = [])
    {
        return $this->executeQueryAll($sql, $params)[0];
    }

    /**
     * Метод возвращает выборку из таблицы БД
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function executeQueryAll(string $sql, array $params = [])
    {
        // Метод fetchAll объекта PDOStatement возвращает данные из запроса
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Метод выполняет простые запросы в БД без выборки.
     * @param string $sql
     * @param array $params
     */
    public function executeQuery(string $sql, array $params = [])
    {
        $this->query($sql, $params);
    }

    /**
     * Метод подготавливает строку с параметрами подлючения к БД для PDO
     * @return string - строка вида: mysql:host=$host;dbname=$db;charset=$charset
     */
    private function prepareDsnString(): string
    {

        return sprintf("%s:host=%s;port=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['port'],
            $this->config['database'],
            $this->config['charset']
        );
    }
}