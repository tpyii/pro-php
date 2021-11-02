<?php

session_start();

use app\core\Request;

include '../config/config.php';
include '../core/Autoload.php';
include '../vendor/autoload.php';

spl_autoload_register([new Autoload, 'loadClass']);

$controller = Request::getInstance()->getController();

if (class_exists($controller)) {
  $method = Request::getInstance()->getMethod();
  $id = Request::getInstance()->getParams();

  echo (new $controller)->$method($id);
} else {
  die('404: Page not found');
}
