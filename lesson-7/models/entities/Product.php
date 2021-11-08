<?php

namespace app\models\entities;

use app\core\Entity;

class Product extends Entity
{
  public $id;
  public $name;
  public $price;

  public function __construct($name = null, $price = null)
  {
    $this->name = $name;
    $this->price = $price;
  }
}
