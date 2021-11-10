<?php

namespace app\core;

class Response
{
  public function redirect($path)
  {
    if ($path === 'back') {
      $path = parse_url($_SERVER['HTTP_REFERER'])['path'];
    }
        
    header("Location: {$path}");
    die;
  }
}
