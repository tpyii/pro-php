<?php

namespace app\core;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use app\interfaces\IRender;

class TwigRender implements IRender
{
  private $instance;

  private function getInstance()
  {
    $loader = new FilesystemLoader(TEMPLATES_DIR);
    $this->instance = new Environment($loader);

    return $this->instance;
  }

  public function renderTemplate($template, $params = [])
  {
    if (is_null($this->instance)) {
      $this->instance = $this->getInstance();
    }

    return $this->instance->render("{$template}.twig", $params);
  }
}
