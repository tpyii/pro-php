<?php

namespace app\core;

use app\core\Db;
use app\core\Request;
use app\core\Session;
use app\core\Storage;
use app\core\Response;
use app\traits\TSingletone;
use app\models\repositories\UserRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;

/**
 * @property Request $request
 * @property Response $response
 * @property Session $session
 * @property Db $db
 * @property BasketRepository $basketRepository
 * @property ProductRepository $productRepository
 * @property UserRepository $userRepository
 * @property OrderRepository $orderRepository
 */
class App
{
  use TSingletone;

  public $config;
  private $components;
  private $controller;
  private $action;

  public function __get($name)
  {
    return $this->components->get($name);
  }

  public static function call()
  {
    return static::getInstance();
  }

  public function run($config)
  {
    $this->config = $config;
    $this->components = new Storage;

    return $this->runController();
  }

  private function runController()
  {
    $this->controller = $this->request->getController();

    if (class_exists($this->controller)) {
      $this->action = $this->request->getAction();
      $action = $this->action;
      
      return (new $this->controller)->$action($this->request);
    } else {
      die('404: Page not found');
    }
  }

  public function createComponent($name)
  {
    if (isset($this->config['components'][$name])) {

      if (is_array($this->config['components'][$name])) {
        $params = $this->config['components'][$name];
        $class = $params['class'];

        if (class_exists($class)) {
          unset($params['class']);
          $reflection = new \ReflectionClass($class);
          return $reflection->newInstanceArgs($params);
        }
      } else {
        return new $this->config['components'][$name];
      }
    }

    die("Компонент {$name} не существует в конфигурации системы!");
  }

  public function getRender()
  {
    return new $this->config['render'];
  }
}
