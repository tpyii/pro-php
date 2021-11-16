<?php

namespace app\models\repositories;

use app\core\Repository;
use app\models\entities\Product;

class ProductRepository extends Repository
{
  protected function getTableName()
  {
    return 'products';
  }

  protected function getEntityClass()
  {
    return Product::class;
  }
}
