<?php

namespace app\controllers;

use app\models\Product;
use app\core\Response;

class ProductsController
{
  public function index()
  {
    return Response::view('products/index', [
      'products' => Product::getAll(),
    ]);
  }

  public function show($id)
  {
    return Response::view('products/show', [
      'product' => Product::getOne((int) $id),
    ]);
  }
}
