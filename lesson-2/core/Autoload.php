<?php

class Autoload
{
  public function loadClass($name)
  {
    $name = str_replace('\\', '/', str_replace('app', '..', $name)) . '.php';

    if (file_exists($name)) {
      include $name;
    }
  }
}
