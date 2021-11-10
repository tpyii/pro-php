<?php

namespace app\models\repositories;

use app\core\Repository;
use app\models\entities\Order;

class OrderRepository extends Repository
{
  protected function getTableName()
  {
    return 'orders';
  }

  protected function getEntityClass()
  {
    return Order::class;
  }

  public function get()
  {
    $sql = sprintf(
      "SELECT
          o.id,
          o.email,
          o.status,
          count(b.id) count,
          sum(b.price) sum
        FROM
          %s o
        JOIN basket b ON o.session_id = b.session_id
        GROUP BY o.id",
      $this->getTableName()
    );

    return parent::getAll($sql);
  }

  public function getOrder($id)
  {
    $sql = sprintf(
      "SELECT o.id, b.product_id, b.price, p.name
        FROM %s o
        JOIN basket b ON b.session_id = o.session_id
        JOIN products p ON p.id = b.product_id
       WHERE o.id = :id", 
      $this->getTableName()
    );

    return parent::getAll($sql, ['id' => $id]);
  }
}
