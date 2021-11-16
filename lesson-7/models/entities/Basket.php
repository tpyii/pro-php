<?php

namespace app\models\entities;

use app\core\Entity;

class Basket extends Entity
{
  public $id;
  public $product_id;
  public $price;
  public $session_id;

  public function __construct($product_id = null, $price = null, $session_id = null)
  {
    $this->product_id = $product_id;
    $this->price = $price;
    $this->session_id = $session_id;
  }
}
