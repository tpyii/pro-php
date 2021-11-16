<?php

namespace app\controllers;

use app\core\App;
use app\core\Render;
use app\core\Request;
use app\models\entities\Basket;

class BasketController
{
  public function index()
  {
    return (new Render(App::call()->getRender()))->view('basket', [
      'items' => App::call()->basketRepository->get(session_id()),
      'flash' => App::call()->session->getFlash(),
    ]);
  }

  public function store(Request $request)
  {
    if ( ! $product = App::call()->productRepository->getOne((int) $request->getParam('product_id'))) {
      App::call()->session->setFlash('message', 'Товар не найден');
    } else {
      $basket = new Basket($product->id, $product->price, session_id());
      App::call()->basketRepository->save($basket);
      App::call()->session->setFlash('message', "Товар \"{$product->name}\" добавлен в корзину");
    }

    return App::call()->response->redirect('back');
  }

  public function destroy(Request $request)
  {
    if ( ! $basket = App::call()->basketRepository->getOneWhere(['id' => (int) $request->getId(), 'session_id' => session_id()])) {
      App::call()->session->setFlash('message', 'Товар не найден');
    } else {
      App::call()->basketRepository->delete($basket);
      App::call()->session->setFlash('message', 'Товар удален из корзины');
    }

    return App::call()->response->redirect('back');
  }
}
