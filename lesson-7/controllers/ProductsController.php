<?php

namespace app\controllers;

use app\core\Render;
use app\core\Request;
use app\core\Session;
use app\core\TwigRender;
use app\models\repositories\ProductRepository;

class ProductsController
{
  public function index()
  {
    return (new Render(new TwigRender))->view('products/index', [
      'products' => (new ProductRepository)->getAll(),
      'flash' => Session::getInstance()->getFlash(),
    ]);
  }

  public function show(Request $request)
  {
    return (new Render(new TwigRender))->view('products/show', [
      'product' => (new ProductRepository)->getOne((int) $request->getId()),
      'flash' => Session::getInstance()->getFlash(),
    ]);
  }
}
