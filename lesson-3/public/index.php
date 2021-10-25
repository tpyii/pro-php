<?php

use app\models\Product;

include '../config/config.php';
include '../core/Autoload.php';

spl_autoload_register([new Autoload, 'loadClass']);

// $product = new Product('Телефон', 19999);
// $product->insert();
// $product = (new Product)->getOne(1);
// $product->price = 9999;
// $product->update();
// $product->delete();
