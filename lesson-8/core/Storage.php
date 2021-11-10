<?php

namespace app\core;

class Storage
{
  private $items = [];

  public function get($name)
  {
    if ( ! isset($this->items[$name])) {
      $this->items[$name] = App::call()->createComponent($name);
    }

    return $this->items[$name];
  }
}
