<?php

namespace app\controllers;

use app\core\Render;
use app\core\TwigRender;

class HomeController
{
  public function index()
  {
    return (new Render(new TwigRender))->view('index');
  }
}
