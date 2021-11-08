<?php

namespace app\traits;

trait TSingletone
{
  private static $instace;

  private function __construct() {}
  private function __clone() {}

  public static function getInstance()
  {
    if (is_null(static::$instace)) {
      static::$instace = new static();
    }

    return static::$instace;
  } 
}
