<?php

namespace app\controllers;

use app\core\App;
use app\core\Render;
use app\core\Request;

class ProductsController
{
  public function index()
  {
    return (new Render(App::call()->getRender()))->view('products/index', [
      'products' => App::call()->productRepository->getAll(),
      'flash' => App::call()->session->getFlash(),
    ]);
  }

  public function show(Request $request)
  {
    return (new Render(App::call()->getRender()))->view('products/show', [
      'product' => App::call()->productRepository->getOne((int) $request->getId()),
      'flash' => App::call()->session->getFlash(),
    ]);
  }
}
