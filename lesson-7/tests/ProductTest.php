<?php

use app\models\entities\Product;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
  public function testProductName()
  {
    $name = 'Чай';
    $product = new Product($name);

    $this->assertEquals($name, $product->name);
  }

  public function testProductPrice()
  {
    $name = 'Чай';
    $price = 1000.00;
    $product = new Product($name, $price);

    $this->assertEquals($price, $product->price);
  }
}
