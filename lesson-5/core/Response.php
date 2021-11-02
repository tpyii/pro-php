<?php

namespace app\core;

use app\traits\TSingletone;

class Response
{
  use TSingletone;
  
  public function redirect($path)
  {
    if ($path === 'back') {
      $path = parse_url($_SERVER['HTTP_REFERER'])['path'];
    }
        
    header("Location: {$path}");
    die;
  }
}
