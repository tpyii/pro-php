<?php

namespace app\core;

abstract class Repository
{
  abstract protected function getTableName();
  abstract protected function getEntityClass();

  public function insert(Entity $entity)
  {
    $params = array_filter(get_object_vars($entity), function($key) {
      return $key !== 'id';
    }, ARRAY_FILTER_USE_KEY);

    $sql = sprintf("INSERT INTO %s (%s) VALUES (:%s)", 
      $this->getTableName(),
      implode(', ', array_keys($params)),
      implode(', :', array_keys($params))
    );

    App::call()->db->execute($sql, $params);
    $entity->id = App::call()->db->lastInsertId();

    return $this;
  }

  public function update(Entity $entity)
  {
    $params = array_filter(get_object_vars($entity), function($key) {
      return $key !== 'id';
    }, ARRAY_FILTER_USE_KEY);

    $sql = sprintf("UPDATE %s SET %s WHERE id = :id", 
      $this->getTableName(),
      implode(', ', array_map(function($field) {
        return "{$field} = :{$field}";
      }, array_keys($params)))
    );

    App::call()->db->execute($sql, get_object_vars($entity));

    return $this;
  }

  public function delete(Entity $entity)
  {
    $sql = sprintf("DELETE FROM %s WHERE id = :id", $this->getTableName());

    return App::call()->db->execute($sql, ['id' => $entity->id]);
  }

  public function save(Entity $entity)
  {
    if (is_null($entity->id)) {
      return $this->insert($entity);
    } else {
      return $this->update($entity);
    }
  }

  public function getOne($id)
  {
    $sql = sprintf("SELECT * FROM %s WHERE id = :id", $this->getTableName());

    return App::call()->db->getOneObject($sql, ['id' => $id], $this->getEntityClass());
  }

  public function getAll($sql = null, $params = [])
  {
    $sql = $sql ?? sprintf("SELECT * FROM %s", $this->getTableName());

    return App::call()->db->getAll($sql, $params);
  }

  public function getWhere($params)
  {
    $sql = $this->getSqlWhere($params);

    return App::call()->db->getAll($sql, $params);
  }

  public function getOneWhere($params)
  {
    $sql = $this->getSqlWhere($params);

    return App::call()->db->getOneObject($sql, $params, $this->getEntityClass());
  }

  private function getSqlWhere($params)
  {
    return sprintf("SELECT * FROM %s WHERE %s", 
      $this->getTableName(),
      implode(' AND ', array_map(function($field) {
        return "{$field} = :{$field}";
      }, array_keys($params)))
    );
  }
}
