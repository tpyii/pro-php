<?php

namespace app\core;

abstract class Model
{
  private $db;

  public function __construct()
  {
    $this->table = $this->getTableName();
    $this->db = new Db;  
  }

  private function getTableName()
  {
    return $this->table ?? lcfirst(array_pop(explode('\\', get_class($this)))) . 's';
  }

  public function getOne($id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
    $this->db->getOne($sql);
  }

  public function getAll()
  {
    $sql = "SELECT * FROM {$this->table}";
    $this->db->getAll($sql);
  }
}
