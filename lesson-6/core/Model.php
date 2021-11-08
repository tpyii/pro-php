<?php

namespace app\core;

use app\interfaces\IModel;

abstract class Model implements IModel
{
  public function __isset($name)
  {
    return isset($this->$name);
  }

  abstract protected static function getTableName();

  public function insert()
  {
    $params = array_filter(get_object_vars($this), function($key) {
      return $key !== 'id';
    }, ARRAY_FILTER_USE_KEY);

    $sql = sprintf("INSERT INTO %s (%s) VALUES (:%s)", 
      static::getTableName(),
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
      static::getTableName(),
      implode(', ', array_map(function($field) {
        return "{$field} = :{$field}";
      }, array_keys($params)))
    );

    Db::getInstance()->execute($sql, get_object_vars($this));

    return $this;
  }

  public function delete()
  {
    $sql = sprintf("DELETE FROM %s WHERE id = :id", static::getTableName());

    return Db::getInstance()->execute($sql, ['id' => $this->id]);
  }

  public static function getOne($id)
  {
    $sql = sprintf("SELECT * FROM %s WHERE id = :id", static::getTableName());

    return Db::getInstance()->getOneObject($sql, ['id' => $id], static::class);
  }

  public static function getAll($sql = null, $params = [])
  {
    $sql = $sql ?? sprintf("SELECT * FROM %s", static::getTableName());

    return Db::getInstance()->getAll($sql, $params);
  }

  public static function getWhere($params)
  {
    $sql = static::getSqlWhere($params);

    return Db::getInstance()->getAll($sql, $params);
  }

  public static function getOneWhere($params)
  {
    $sql = static::getSqlWhere($params);

    return Db::getInstance()->getOneObject($sql, $params, static::class);
  }

  private static function getSqlWhere($params)
  {
    return sprintf("SELECT * FROM %s WHERE %s", 
      static::getTableName(),
      implode(' AND ', array_map(function($field) {
        return "{$field} = :{$field}";
      }, array_keys($params)))
    );
  }
}
