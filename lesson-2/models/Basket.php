<?php

namespace app\models;

use app\core\Model;

class Basket extends Model
{
  protected $table = 'basket';
  protected $items = [];

  public function addItem($item)
  {
    $this->items[] = $item;
  }

  public function getItems()
  {
    return $this->items;
  }
}
