<?php

namespace app\core;

class Db
{
  private $wheres = [];

  public function __construct()
  {
    $this->table = $this->getTable();
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

  private function getTable()
  {
    return $this->table ?? lcfirst(array_pop(explode('\\', get_class($this)))) . 's';
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
