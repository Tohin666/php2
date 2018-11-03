<?php

class MyTest extends \PHPUnit\Framework\TestCase
{
    public function testFirst()
    {
        $a = 2 + 2;
        $this->assertEquals(4, $a);
        $this->assertGreaterThan(0, $a);
        $this->assertTrue(is_numeric($a));
    }

    public function testProduct()
    {
        $product = new \app\models\Product();
        $string = "This is some description that must be greater than thirty five symbols";
        $product->description = $string;

        $result = $product->getShortDescription();
        $this->assertTrue(is_string($result));
        $this->assertEquals(35, mb_strlen($result));
        $this->assertEquals(mb_substr($string, 0, 35), $result);
    }
}