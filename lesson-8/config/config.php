<?php

use app\core\Db;
use app\core\Request;
use app\core\Response;
use app\core\Session;
use app\core\TwigRender;
use app\models\repositories\BasketRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;

return [
  'root' => dirname(__DIR__),
  'home' => 'home',
  'controllers_namespace' => 'app\\controllers\\',
  'views_dir' => dirname(__DIR__) . '/views/',
  'templates_dir' => dirname(__DIR__) . '/templates/',
  'render' => TwigRender::class,
  'components' => [

    // Core

    'db' => [
      'class' => Db::class,
      'driver' => 'mysql',
      'host' => 'localhost:8889',
      'database' => 'pro-php',
      'user' => 'root',
      'password' => 'root',
      'options' => [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
      ]
    ],
    'request' => Request::class,
    'response' => Response::class,
    'session' => Session::class,

    // Repositories

    'basketRepository' => BasketRepository::class,
    'productRepository' => ProductRepository::class,
    'userRepository' => UserRepository::class,
    'orderRepository' => OrderRepository::class
  ]
];
