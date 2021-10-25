<?php

namespace app\models;

use app\core\Model;

class Product extends Model
{
  public $id;
  public $name;
  public $price;

  public function __construct($name = null, $price = null)
  {
    $this->name = $name;
    $this->price = $price;
  }

  public function getTableName()
  {
    return 'products';
  }
}
