<?php

/**
 * Class Product Класс товара.
 */
class Product
{
    // Свойства класса (товара): ID, название, описание, количество, вес, цвет, размер, производитель.
    public $id;
    public $name;
    public $description;
    public $quantity;
    public $weight;
    public $color;
    public $size;
    public $vendor;

    public function __construct($name, $description = null, $quantity = null, $weight = null, $color = null,
                                $size = null, $vendor = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->weight = $weight;
        $this->color = $color;
        $this->size = $size;
        $this->vendor = $vendor;
    }

    // Метод создания товара.
    public function createProduct()
    {
        $sql = "INSERT INTO products (name, description, quantity, weight, color, size, vendor) 
                values ('$this->name', '$this->description', '$this->quantity', '$this->weight', 
                '$this->color', '$this->size', '$this->vendor')";
        // Функция добавляет товар в базу и возвращает сгенерированный id
        $this->id = executeQuery($sql);
    }

    // Метод поступления товара на склад.
    public function addProductToDB($id, $quantity)
    {
        $sql = "UPDATE products SET quantity = quantity + $quantity WHERE id = $id";
        executeQuery($sql);
    }

    // Метод добавления товара в заказ.
    public function addProductToOrder($id, $orderID, $quantity)
    {
        $sql = "INSERT INTO orders (id, orderID, quantity) values ($id, $orderID, $quantity)";
        executeQuery($sql);
    }

    // Метод удаления товара.
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = $id";
        executeQuery($sql);
    }
}

/**
 * Class Phones Дочерний класс телефоны.
 */
class Phones extends Product
{
    public $processor;
    public $memory;
    public $resolution;
    public $serialNumber;

    public function __construct($name, $description = null, $quantity = null, $weight = null, $color = null,
                                $size = null, $vendor = null, $processor = null, $memory = null, $resolution = null,
                                $serialNumber = null)
    {
        parent::__construct($name, $description, $quantity, $weight, $color, $size, $vendor);
        $this->processor = $processor;
        $this->memory = $memory;
        $this->resolution = $resolution;
        $this->serialNumber = $serialNumber;
    }

    // Метод возврата товара на гарантийный ремонт.
    public function service($id, $serialNumber)
    {
        // Функция проверяет серийный номер по базе.
        if (checkSerialNumber($serialNumber)) {
            // Функция добаляет товар в очередь на ремонт.
            addProductToService($id);
        }
    }
}

?>


5. Статическая переменная задается в классе, и при изменении значения меняется и во всех экземплярах класса. Поэтому переменная будет увеличиваться на 1 при каждом вызове, и соответственно выведется 1 2 3 4.

6. Здесь создается дочерний класс, и статическая переменная копируется. При вызове методов этих классов статические переменные будут инкрементироваться независимо друг от друга, соответственно выведется 1 1 2 2

7. Данный код выведет тоже что и предыдущий, т.к. скобки при вызове метода указывать не обязательно, и код сработает точно также. Но все же желательно скобки указывать.