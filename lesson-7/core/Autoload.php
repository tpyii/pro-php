<?php

class Autoload
{
  public function loadClass($name)
  {
    $name = str_replace(['app\\', '\\'], [ROOT . DS, DS], $name) . '.php';

    if (file_exists($name)) {
      include $name;
    }
  }
}
