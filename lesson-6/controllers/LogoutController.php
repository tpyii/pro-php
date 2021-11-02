<?php

namespace app\controllers;

use app\core\Auth;
use app\core\Response;
use app\core\Session;

class LogoutController
{
  public function index()
  {
    if ( ! Auth::check()) {
      return Response::getInstance()->redirect(HOME_CONTROLLER);
    }
    
    if ( ! Auth::logout()) {
      Session::getInstance()->setFlash('message', 'Не удалось выполнить выход');
      
      return Response::getInstance()->redirect('back');
    }

    return Response::getInstance()->redirect(HOME_CONTROLLER);
  }
}
