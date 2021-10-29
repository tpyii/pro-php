<?php

namespace app\core;

use app\traits\TSingletone;

class Db
{
  use TSingletone;

  private $config = [
    'driver' => 'mysql',
    'host' => 'localhost:8889',
    'database' => 'pro-php',
    'user' => 'root',
    'password' => 'root'
  ];

  private $options = [
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
  ];

  private $connection;

  private function getConnection()
  {
    if (is_null($this->connection)) {
      $this->connection = new \PDO($this->prepareDsnString(), 
        $this->config['user'], 
        $this->config['password'],
        $this->options
      );
    }

    return $this->connection;
  }

  private function prepareDsnString()
  {
    return sprintf('%s:host=%s;dbname=%s', 
      $this->config['driver'], 
      $this->config['host'], 
      $this->config['database']
    );
  }

  private function query($sql, $params)
  {
    $sth = $this->getConnection()->prepare($sql);
    $sth->execute($params);

    return $sth;
  }

  public function lastInsertId()
  {
    return $this->getConnection()->lastInsertId();
  }

  public function getOne($sql, $params = [])
  {
    return $this->query($sql, $params)->fetch();
  }

  public function getOneObject($sql, $params, $class)
  {
    $sth = $this->query($sql, $params);
    $sth->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);

    return $sth->fetch();
  }

  public function getAll($sql, $params = [])
  {
    return $this->query($sql, $params)->fetchAll();
  }

  public function execute($sql, $params = [])
  {
    return $this->query($sql, $params)->rowCount();
  }
}
