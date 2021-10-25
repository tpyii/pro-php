<?php

namespace app\core;

use app\traits\TSingletone;

class Request
{
  use TSingletone;

  private $id;

  public function setFlash($key, $message)
  {
    $_SESSION['flash'][$key] = $message;
  }

  public function getFlash()
  {
    if (isset($_SESSION['flash'])) {
      $flash = $_SESSION['flash'];

      unset($_SESSION['flash']);

      return $flash;
    }
  }

  public function getParams()
  {
    return $this->id;
  }

  public function getController()
  {
    $url = parse_url($_SERVER['REQUEST_URI'])['path'];
    
    if ($url === '/') {
      $controller = HOME_CONTROLLER;
    } else {
      list($controller, $this->id) = array_slice(explode('/', $url), 1);
    }

    return CONTROLLERS_NAMESPACE . ucfirst($controller) . 'Controller';
  }

  public function getMethod()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        $method = $this->get();
        break;
    
      case 'POST':
        $method = $this->post();
        break;
    
      case 'PUT':
        $method = $this->put();
        break;
    
      case 'DELETE':
        $method = $this->delete();
        break;
    }

    return $method;
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
