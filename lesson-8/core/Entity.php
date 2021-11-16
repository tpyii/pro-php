<?php

namespace app\core;

class Entity
{
  public function __get($name)
  {
    return $this->$name;  
  }

  public function __isset($name)
  {
    return isset($this->$name);
  }
}
