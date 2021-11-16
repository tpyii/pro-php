<?php

namespace app\models\repositories;

use app\core\Repository;
use app\models\entities\Basket;

class BasketRepository extends Repository
{
  protected function getTableName()
  {
    return 'basket';
  }

  protected function getEntityClass()
  {
    return Basket::class;
  }

  public function get($session_id)
  {
    $sql = sprintf(
      "SELECT b.id, b.product_id, b.price, p.name
        FROM %s b
        JOIN products p ON p.id = b.product_id
       WHERE session_id = :session_id", 
      $this->getTableName()
    );

    return parent::getAll($sql, ['session_id' => $session_id]);
  }
}
