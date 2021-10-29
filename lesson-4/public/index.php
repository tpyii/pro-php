<?php

use app\core\Request;

session_start();

include '../config/config.php';
include '../core/Autoload.php';

spl_autoload_register([new Autoload, 'loadClass']);

$controller = Request::getInstance()->getController();

if (class_exists($controller)) {
  $method = Request::getInstance()->getMethod();
  $id = Request::getInstance()->getParams();

  echo (new $controller)->$method($id);
} else {
  die('404: Page not found');
}
