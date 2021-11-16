<?php

namespace app\models\entities;

use app\core\Entity;

class Order extends Entity
{
  public $id;
  public $email;
  public $status;
  public $session_id;

  public function __construct($email = null, $session_id = null, $status = 'moderation')
  {
    $this->email = $email;
    $this->session_id = $session_id;
    $this->status = $status;
  }
}
