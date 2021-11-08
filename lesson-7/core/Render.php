<?php

namespace app\core;

use app\core\Session;
use app\interfaces\IRender;

class Render
{
  protected $render;

  public function __construct(IRender $render)
  {
    $this->render = $render;
  }

  public function view($template, $params = [])
  {
    return $this->render($template, $params);
  }

  private function render($template, $params)
  {
    return $this->render->renderTemplate('layouts/main', [
      'menu' => $this->render->renderTemplate('menu', [
        'login' => Session::getInstance()->get('login'),
      ]),
      'content' => $this->render->renderTemplate($template, $params),
    ]);
  }
}
