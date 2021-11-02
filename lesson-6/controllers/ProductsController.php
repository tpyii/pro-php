<?php

namespace app\controllers;

use app\core\Render;
use app\core\Request;
use app\core\Session;
use app\models\Product;
use app\core\TwigRender;

class ProductsController
{
  public function index()
  {
    return (new Render(new TwigRender))->view('products/index', [
      'products' => Product::getAll(),
      'flash' => Session::getInstance()->getFlash(),
    ]);
  }

  public function show(Request $request)
  {
    return (new Render(new TwigRender))->view('products/show', [
      'product' => Product::getOne((int) $request->getId()),
      'flash' => Session::getInstance()->getFlash(),
    ]);
  }
}
