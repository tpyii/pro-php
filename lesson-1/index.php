<?php

class Product 
{
  public $name;
  public $price;

  public function __construct($name = null, $price = null)
  {
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

class Book extends Product
{
  public $author;

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

class Db
{
  public $table;
  public $wheres = [];

  public function table($table)
  {
    $this->table = $table;
    
    return $this;
  }

  public function where($field, $value)
  {
    $this->wheres[] = [
      'field' => $field,
      'value' => $value
    ];

    return $this;
  }

  public function andWhere($field, $value)
  {
    $this->where($field, $value);

    return $this;
  }

  public function get()
  {
    $sql = "SELECT * FROM {$this->table}";

    if ( ! empty($this->wheres)) {
      $sql .= $this->getWhereQueryString();
    }

    $this->clean();

    return $sql;
  }

  private function getWhereQueryString()
  {
    return ' WHERE ' . implode(' AND ', array_map(function($array) {
      return implode(' = ', $array);
    }, $this->wheres));
  }

  private function clean()
  {
    $this->table = '';
    $this->wheres = [];
  }
}

$book = new Book('Дюна', 699, 'Герберт Фрэнк');

$db = new Db;
echo $db->table('product')
        ->where('name', 'Alex')
        ->andWhere('session', 123)
        ->andWhere('id', 5)
        ->get();
