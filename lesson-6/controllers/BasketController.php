<?php

namespace app\controllers;

use app\core\Render;
use app\core\Request;
use app\core\Session;
use app\core\Response;
use app\models\Basket;
use app\models\Product;
use app\core\TwigRender;

class BasketController
{
  public function index()
  {
    return (new Render(new TwigRender))->view('basket', [
      'items' => Basket::get(session_id()),
      'flash' => Session::getInstance()->getFlash(),
    ]);
  }

  public function store(Request $request)
  {
    $id = (int) $request->getParam('product_id');

    if ( ! $product = Product::getOne($id)) {
      Session::getInstance()->setFlash('message', 'Товар не найден');
    } else {
      (new Basket($product->id, $product->price, session_id()))->insert();
      Session::getInstance()->setFlash('message', "Товар \"{$product->name}\" добавлен в корзину");
    }

    return Response::getInstance()->redirect('back');
  }

  public function destroy(Request $request)
  {
    $id = (int) $request->getId();

    if ( ! $basket = Basket::getOneWhere(['id' => $id, 'session_id' => session_id()])) {
      Session::getInstance()->setFlash('message', 'Товар не найден');
    } else {
      $basket->delete();
      Session::getInstance()->setFlash('message', 'Товар удален из корзины');
    }

    return Response::getInstance()->redirect('back');
  }
}
