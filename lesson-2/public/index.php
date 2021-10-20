<?php

use app\models\Book;
use app\models\Basket;

include '../config/config.php';
include '../core/Autoload.php';

spl_autoload_register([new Autoload, 'loadClass']);

$basket = new Basket;
$book = new Book('Дюна', 699, 'Герберт Фрэнк');
$book->getOne(1);

$basket->addItem($book);
