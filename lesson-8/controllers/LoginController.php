<?php

namespace app\controllers;

use app\core\App;
use app\core\Render;
use app\core\Request;

class LoginController
{
  public function index()
  {
    if (App::call()->userRepository->check()) {
      return App::call()->response->redirect(App::call()->config['home']);
    }

    return (new Render(App::call()->getRender()))->view('login', [
      'flash' => App::call()->session->getFlash(),
    ]);
  }

  public function store(Request $request)
  {
    if (App::call()->userRepository->check()) {
      return App::call()->response->redirect(App::call()->config['home']);
    }
    
    if ( ! App::call()->userRepository->auth($request->getParam('login'), $request->getParam('password'))) {
      App::call()->session->setFlash('message', 'Неверные данные');

      return App::call()->response->redirect('back');
    }

    return App::call()->response->redirect(App::call()->config['home']);
  }
}
