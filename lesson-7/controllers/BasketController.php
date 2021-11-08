<?php

namespace app\controllers;

use app\core\Render;
use app\core\Request;
use app\core\Session;
use app\core\Response;
use app\core\TwigRender;
use app\models\entities\Basket;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;

class BasketController
{
  public function index()
  {
    return (new Render(new TwigRender))->view('basket', [
      'items' => (new BasketRepository)->get(session_id()),
      'flash' => Session::getInstance()->getFlash(),
    ]);
  }

  public function store(Request $request)
  {
    $id = (int) $request->getParam('product_id');

    if ( ! $product = (new ProductRepository)->getOne($id)) {
      Session::getInstance()->setFlash('message', 'Товар не найден');
    } else {
      $basket = new Basket($product->id, $product->price, session_id());
      (new BasketRepository)->save($basket);
      Session::getInstance()->setFlash('message', "Товар \"{$product->name}\" добавлен в корзину");
    }

    return Response::getInstance()->redirect('back');
  }

  public function destroy(Request $request)
  {
    $id = (int) $request->getId();

    if ( ! $basket = (new BasketRepository)->getOneWhere(['id' => $id, 'session_id' => session_id()])) {
      Session::getInstance()->setFlash('message', 'Товар не найден');
    } else {
      (new BasketRepository)->delete($basket);
      Session::getInstance()->setFlash('message', 'Товар удален из корзины');
    }

    return Response::getInstance()->redirect('back');
  }
}
