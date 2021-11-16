<?php

namespace app\core;

use app\interfaces\IRender;

class BasicRender implements IRender
{
  public function renderTemplate($template, $params = [])
  {
    ob_start();
    extract($params);
    
    $file = VIEWS_DIR . DS. "{$template}.php";

    if (file_exists($file)) {
      include $file;
    }

    return ob_get_clean();
  }
}
