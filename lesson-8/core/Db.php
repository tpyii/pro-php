<?php

namespace app\core;

class Db
{
  private $config;
  private $connection;

  public function __construct($driver, $host, $database, $user, $password, $options)
  {
    $this->config['driver'] = $driver;
    $this->config['host'] = $host;
    $this->config['database'] = $database;
    $this->config['user'] = $user;
    $this->config['password'] = $password;
    $this->config['options'] = $options;
  }

  private function getConnection()
  {
    if (is_null($this->connection)) {
      $this->connection = new \PDO($this->prepareDsnString(), 
        $this->config['user'], 
        $this->config['password'],
        $this->config['options']
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
