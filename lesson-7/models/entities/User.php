<?php

namespace app\models\entities;

use app\core\Entity;

class User extends Entity
{
  public $id;
  public $login;
  public $password;

  public function __construct($login = null, $password = null)
  {
    $this->login = $login;
    $this->password = $password;
  }
}
