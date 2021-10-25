<?php

namespace app\core;

use app\core\Request;

class Response
{
  public static function redirect($path)
  {
    if ($path === 'back') {
      $path = parse_url($_SERVER['HTTP_REFERER'])['path'];
    }
        
    header("Location: {$path}");
    die;
  }

  public static function view($template, $params = [])
  {
    $params['flash'] = Request::getInstance()->getFlash() ?? ['message' => ''];

    return static::render($template, $params);
  }

  private static function render($template, $params)
  {
    return static::getTemplate('layouts/main', [
      'menu' => static::getTemplate('menu'),
      'content' => static::getTemplate($template, $params),
    ]);
  }

  private static function getTemplate($template, $params = [])
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
