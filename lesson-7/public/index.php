<?php

session_start();

use app\core\Request;

include '../config/config.php';;
include '../vendor/autoload.php';

try {

  $request = new Request();
  $controller = $request->getController();

  if (class_exists($controller)) {
    $action = $request->getAction();
    
    echo (new $controller)->$action($request);
  } else {
    die('404: Page not found');
  }

} catch (\Throwable $th) {
  var_dump($th->getMessage());
}
