<?php

namespace app\interfaces;

interface IModel
{
  public function insert();
  public function update();
  public function delete();
  public static function getOne($id);
  public static function getAll($sql = null, $params = []);
}
