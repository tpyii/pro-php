<?php

namespace app\controllers;

use app\core\App;
use app\core\Render;

class HomeController
{
  public function index()
  {
    return (new Render(App::call()->getRender()))->view('index');
  }
}
