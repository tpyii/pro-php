<?php

namespace app\controllers;

use app\models\Basket;
use app\models\Product;
use app\core\Request;
use app\core\Response;

class BasketController
{
  public function index()
  {
    return Response::view('basket', [
      'items' => Basket::get(session_id())
    ]);
  }

  public function store()
  {
    $id = (int) $_POST['product_id'];

    if ( ! $product = Product::getOne($id)) {
      $message = 'Товар не найден';
    } else {
      $basket = new Basket($product->id, $product->price, session_id());
      $basket->insert();
      $message = "Товар \"{$product->name}\" добавлен в корзину";
    }

    Request::getInstance()->setFlash('message', $message);

    return Response::redirect('back');
  }

  public function destroy($id)
  {
    $id = (int) $id;

    if ( ! $basket = Basket::getOne($id)) {
      $message = 'Товар не найден';
    } else {
      $basket->delete();
      $message = 'Товар удален из корзины';
    }

    Request::getInstance()->setFlash('message', $message);

    return Response::redirect('back');
  }
}
