<?php

session_start();

use app\core\Request;

include '../config/config.php';
include '../core/Autoload.php';
include '../vendor/autoload.php';

spl_autoload_register([new Autoload, 'loadClass']);

$request = new Request();
$controller = $request->getController();

if (class_exists($controller)) {
  $action = $request->getAction();
  
  echo (new $controller)->$action($request);
} else {
  die('404: Page not found');
}
