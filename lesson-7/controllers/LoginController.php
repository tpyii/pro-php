<?php

namespace app\controllers;

use app\core\Auth;
use app\core\Render;
use app\core\Request;
use app\core\Session;
use app\core\Response;
use app\core\TwigRender;

class LoginController
{
  public function index()
  {
    if (Auth::check()) {
      return Response::getInstance()->redirect(HOME_CONTROLLER);
    }

    return (new Render(new TwigRender))->view('login', [
      'flash' => Session::getInstance()->getFlash(),
    ]);
  }

  public function store(Request $request)
  {
    if (Auth::check()) {
      return Response::getInstance()->redirect(HOME_CONTROLLER);
    }
    
    if ( ! Auth::attempt($request->getParam('login'), $request->getParam('password'))) {
      Session::getInstance()->setFlash('message', 'Неверные данные');

      return Response::getInstance()->redirect('back');
    }

    return Response::getInstance()->redirect(HOME_CONTROLLER);
  }
}
