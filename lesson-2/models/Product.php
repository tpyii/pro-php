<?php

namespace app\models;

use app\core\Model;

class Product extends Model
{
  protected $name;
  protected $price;

  public function __construct($name = null, $price = null)
  {
    parent::__construct();

    $this->name = $name;
    $this->price = $price;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getPrice()
  {
    return $this->price;
  }
}
