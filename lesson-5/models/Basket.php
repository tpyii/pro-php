<?php

namespace app\models;

use app\core\Model;
use app\core\Db;

class Basket extends Model
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

  protected static function getTableName()
  {
    return 'basket';
  }

  public static function get($session_id)
  {
    $sql = sprintf(
      "SELECT b.id, b.product_id, b.price, p.name
        FROM %s b
        JOIN products p ON p.id = b.product_id
       WHERE session_id = :session_id", 
      static::getTableName()
    );

    return parent::getAll($sql, ['session_id' => $session_id]);
  }
}
