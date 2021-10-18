<?php

use app\models\Basket;
use app\models\Book;

include '../core/Autoload.php';

spl_autoload_register([new Autoload, 'loadClass']);

$basket = new Basket;
$book = new Book('Дюна', 699, 'Герберт Фрэнк');

echo $book->where('name', 'Alex')
       ->andWhere('session', 123)
       ->andWhere('id', 5)
       ->get();

$basket->addItem($book);
