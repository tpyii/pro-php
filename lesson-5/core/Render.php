<?php

namespace app\core;

use app\interfaces\IRender;
use app\core\Request;

class Render
{
  protected $render;

  public function __construct(IRender $render)
  {
    $this->render = $render;
  }

  public function view($template, $params = [])
  {
    $params['flash'] = Request::getInstance()->getFlash() ?? ['message' => ''];

    return $this->render($template, $params);
  }

  private function render($template, $params)
  {
    return $this->render->renderTemplate('layouts/main', [
      'menu' => $this->render->renderTemplate('menu'),
      'content' => $this->render->renderTemplate($template, $params),
    ]);
  }
}
