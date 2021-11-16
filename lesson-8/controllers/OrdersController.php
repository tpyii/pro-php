<?php

namespace app\controllers;

use app\core\App;
use app\core\Render;
use app\core\Request;
use app\models\entities\Order;

class OrdersController
{
  public function index()
  {
    if ( ! App::call()->userRepository->isAdmin()) {
      return App::call()->response->redirect(App::call()->config['home']);
    }

    return (new Render(App::call()->getRender()))->view('orders/index', [
      'orders' => App::call()->orderRepository->get(),
      'flash' => App::call()->session->getFlash(),
    ]);
  }

  public function store(Request $request)
  { 
    $order = new Order($request->getParam('email'), session_id());
    App::call()->orderRepository->save($order);
    App::call()->session->setFlash('message', "Заказ оформлен");

    session_regenerate_id(true);

    return App::call()->response->redirect('back');
  }

  public function show(Request $request)
  {
    if ( ! App::call()->userRepository->isAdmin()) {
      return App::call()->response->redirect(App::call()->config['home']);
    }

    return (new Render(App::call()->getRender()))->view('orders/show', [
      'order' => App::call()->orderRepository->getOne((int) $request->getId()),
      'products' => App::call()->orderRepository->getOrder((int) $request->getId()),
      'flash' => App::call()->session->getFlash(),
    ]);
  }

  public function update(Request $request)
  {
    if ( ! App::call()->userRepository->isAdmin()) {
      return App::call()->response->redirect(App::call()->config['home']);
    }

    if ( ! $order = App::call()->orderRepository->getOne((int) $request->getId())) {
      App::call()->session->setFlash('message', 'Заказ не найден');
    } else {
      $order->status = $request->getParam('status');
      App::call()->orderRepository->save($order);
      App::call()->session->setFlash('message', "Заказ №{$request->getId()} обновлен");
    }

    return App::call()->response->redirect('back');
  }
}
