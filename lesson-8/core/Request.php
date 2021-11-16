<?php

namespace app\core;

class Request
{
  private $url;
  private $controller;
  private $action;
  private $method;
  private $id;
  private $params = [];

  public function __construct()
  {
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->url = parse_url($_SERVER['REQUEST_URI'])['path'];
    $this->parseUrl();
    $this->action = $this->setAction();
    $this->params = $_REQUEST;
  }

  public function getController()
  {
    return $this->controller;
  }

  public function getAction()
  {
    return $this->action;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getParam($key)
  {
    return $this->params[$key];
  }

  private function parseUrl()
  {
    if ($this->url === '/') {
      $controller = App::call()->config['home'];
    } else {
      list($controller, $this->id) = array_slice(explode('/', $this->url), 1);
    }

    $this->controller = App::call()->config['controllers_namespace'] . ucfirst($controller) . 'Controller';
  }

  private function setAction()
  {
    switch ($this->method) {
      case 'GET':
        $action = $this->get();
        break;
    
      case 'POST':
        $action = $this->post();
        break;
    
      case 'PUT':
        $action = $this->put();
        break;
    
      case 'DELETE':
        $action = $this->delete();
        break;
    }

    return $action;
  }

  private function get()
  {
    if ( ! empty($this->id)) {
      return 'show';
    }
    
    return 'index';
  }


  private function post()
  {
    if (isset($_POST['_method'])) {
      if ($_POST['_method'] === 'PUT' && ! empty($this->id)) {
        return 'update';
      } elseif ($_POST['_method'] === 'DELETE' && ! empty($this->id)) {
        return 'destroy';
      }
    }
    
    return 'store';
  }

  private function put()
  {
    if ( ! empty($this->id)) {
      return 'update';
    }
  }

  private function delete()
  {
    if ( ! empty($this->id)) {
      return 'destroy';
    }
  }
}
