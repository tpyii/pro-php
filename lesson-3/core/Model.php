<?php

namespace app\core;

use app\interfaces\IModel;

abstract class Model implements IModel
{
  public function insert()
  {
    $params = array_filter(get_object_vars($this), function($key) {
      return $key !== 'id';
    }, ARRAY_FILTER_USE_KEY);

    $sql = sprintf("INSERT INTO %s (%s) VALUES (:%s)", 
      $this->getTableName(),
      implode(', ', array_keys($params)),
      implode(', :', array_keys($params))
    );

    Db::getInstance()->execute($sql, $params);
    $this->id = Db::getInstance()->lastInsertId();

    return $this;
  }

  public function update()
  {
    $params = array_filter(get_object_vars($this), function($key) {
      return $key !== 'id';
    }, ARRAY_FILTER_USE_KEY);

    $sql = sprintf("UPDATE %s SET %s WHERE id = :id", 
      $this->getTableName(),
      implode(', ', array_map(function($field) {
        return "{$field} = :{$field}";
      }, array_keys($params)))
    );

    Db::getInstance()->execute($sql, get_object_vars($this));

    return $this;
  }

  public function delete()
  {
    $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";

    return Db::getInstance()->execute($sql, ['id' => $this->id]);
  }

  public function getOne($id)
  {
    $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";

    return Db::getInstance()->getOneObject($sql, ['id' => $id], static::class);
  }

  public function getAll()
  {
    $sql = "SELECT * FROM {$this->getTableName()}";

    return Db::getInstance()->getAll($sql);
  }
}
