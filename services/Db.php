<?php

namespace app\services;


//use app\traits\TSingleton;

class Db
//class Db implements IDb
{
//    use TSingleton; // Шаблон создает класс в единственном экземпляре.

    // Конфиг для PDO. Теперь задается в конструкторе ниже, а в конструктор передает App
    private $config = [
//        'driver' => 'mysql',
//        'host' => 'localhost',
//        'port' => '3307',
//        'login' => 'root',
//        'password' => '',
//        'database' => 'myShopDB',
//        'charset' => 'utf8'
    ];

    /**
     * Db constructor.
     */
    public function __construct($driver, $host, $port, $login, $password, $database, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['port'] = $port;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

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
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
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

        // Можно так передать параметр, но мы будем передавать параметр извне.
//        $id = 1;
//        $pdoStatement->bindParam(':id', $id, \PDO::PARAM_INT);

        // Метод execute полученного объекта выполняет запрос
        if (!$pdoStatement->execute($params)) {
            // Если ошибка
            var_dump($this->getConnection()->errorInfo());
        }

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
        // Метод fetchAll объекта PDOStatement возвращает массив, содержащий все строки результирующего набора.
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Метод возвращает выборку из таблицы БД в виде объекта.
     * @param string $sql
     * @param string $class - имя класса, в контексте которого вызван метод.
     * @param array $params
     * @return array
     */
    public function executeQueryObject(string $sql, string $class, array $params = [])
    {
        // $smtp - это подготовленный запрос, мы не меняя всего подключения, устанавливаем режим только для этого
        // конкретного запроса
        $smtp = $this->query($sql, $params);
        // устанавливаем для этого запроса режим доставки в виде объекта и указываем класс, на основе которого он
        // будет создан.
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $class);

        // Метод fetch объекта PDOStatement возвращает данные из запроса, в том виде как мы определили (в виде объекта).
        return $smtp->fetch();
    }


    /**
     * Метод возвращает выборку из таблицы БД в виде массива объектов.
     * @param string $sql
     * @param string $class - имя класса, в контексте которого вызван метод.
     * @param array $params
     * @return array
     */
    public function executeQueryObjects(string $sql, string $class, array $params = [])
    {
        // $smtp - это подготовленный запрос, мы не меняя всего подключения, устанавливаем режим только для этого
        // конкретного запроса
        $smtp = $this->query($sql, $params);
        // устанавливаем для этого запроса режим доставки в виде объекта и указываем класс, на основе которого он
        // будет создан.
        $smtp->setFetchMode(\PDO::FETCH_CLASS, $class);

        // Метод fetchAll объекта PDOStatement возвращает массив объектов.
        return $smtp->fetchAll();
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
     * Метод возвращает ID созданного элемента.
     * @return int - ID последнего созданного элемента
     */
    public function returnLastInsertId()
    {

        return $this->getConnection()->lastInsertId();
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