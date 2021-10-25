<?php

namespace app\controllers;

use app\core\Response;

class HomeController
{
  public function index()
  {
    return Response::view('index');
  }
}
