<?php

namespace app\core;

use app\traits\TSingletone;

class Session
{
  use TSingletone;

  public function setFlash($key, $message)
  {
    $_SESSION['flash'][$key] = $message;
  }

  public function getFlash()
  {
    if (isset($_SESSION['flash'])) {
      $flash = $_SESSION['flash'];
      unset($_SESSION['flash']);

      return $flash;
    }
  }

  public function set($key, $message)
  {
    $_SESSION[$key] = $message;
  }

  public function get($key)
  {
    return $_SESSION[$key];
  }

  public function destroy($key)
  {
    unset($_SESSION[$key]);
  }
}
