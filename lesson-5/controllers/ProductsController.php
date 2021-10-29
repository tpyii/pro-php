<?php

namespace app\controllers;

use app\core\Render;
use app\models\Product;
use app\core\TwigRender;

class ProductsController
{
  public function index()
  {
    return (new Render(new TwigRender))->view('products/index', [
      'products' => Product::getAll(),
    ]);
  }

  public function show($id)
  {
    return (new Render(new TwigRender))->view('products/show', [
      'product' => Product::getOne((int) $id),
    ]);
  }
}
