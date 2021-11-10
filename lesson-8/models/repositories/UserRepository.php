<?php

namespace app\models\repositories;

use app\core\App;
use app\core\Repository;
use app\models\entities\User;

class UserRepository extends Repository
{
  protected function getTableName()
  {
    return 'users';
  }

  protected function getEntityClass()
  {
    return User::class;
  }

  public function auth($login, $password)
  {
    if ( ! $user = $this->getOneWhere(['login' => $login])) {
      return false;
    }

    if ( ! password_verify($password, $user->password)) {
      return false;
    }

    App::call()->session->set('login', $login);

    return true;
  }

  public function check()
  {
    return App::call()->session->get('login');
  }

  public function logout()
  {
    App::call()->session->destroy('login');
    
    return session_regenerate_id(true) && session_destroy();
  }

  public function isAdmin()
  {
    return $this->check() === 'admin';
  }
}
