<?php

session_start();

use app\core\App;

include '../vendor/autoload.php';
$config = include '../config/config.php';

try {

  echo App::call()->run($config);

} catch (\Throwable $th) {
  var_dump($th->getMessage());
}
