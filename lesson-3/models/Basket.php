<?php

namespace app\models;

use app\core\Model;

class Basket extends Model
{
  public $id;
  public $product_id;
  public $price;
  public $session_id;

  public function getTableName()
  {
    return 'basket';
  }
}
