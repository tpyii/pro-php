<?php

namespace app\core;

use app\core\Session;
use app\models\repositories\UserRepository;

class Auth
{
  static public function attempt($login, $password)
  {
    if ( ! $user = (new UserRepository)->getOneWhere(['login' => $login])) {
      return false;
    }

    if ( ! password_verify($password, $user->password)) {
      return false;
    }

    Session::getInstance()->set('login', $login);

    return true;
  }

  static public function check()
  {
    return Session::getInstance()->get('login');
  }

  static public function logout()
  {
    Session::getInstance()->destroy('login');
    
    return session_regenerate_id(true) && session_destroy();
  }
}
