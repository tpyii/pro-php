<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
  public $id;
  public $login;
  public $password;

  public function __construct($login = null, $password = null)
  {
    $this->login = $login;
    $this->password = $password;
  }

  protected static function getTableName()
  {
    return 'users';
  }
}
