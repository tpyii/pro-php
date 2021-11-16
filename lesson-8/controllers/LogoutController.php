<?php

namespace app\controllers;

use app\core\App;

class LogoutController
{
  public function index()
  {
    if ( ! App::call()->userRepository->check()) {
      return App::call()->response->redirect(App::call()->config['home']);
    }
    
    if ( ! App::call()->userRepository->logout()) {
      App::call()->session->setFlash('message', 'Не удалось выполнить выход');
      
      return App::call()->response->redirect('back');
    }

    return App::call()->response->redirect(App::call()->config['home']);
  }
}
