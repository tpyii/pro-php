<?php

namespace app\models;

use app\core\Model;

class Book extends Product
{
  protected $author;

  public function __construct($name = null, $price = null, $author = null)
  {
    parent::__construct($name, $price);

    $this->author = $author;
  }

  public function getAuthor()
  {
    return $this->author;
  }
}
