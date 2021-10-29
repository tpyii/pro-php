<?php

namespace app\interfaces;

interface IModel
{
  public function getTableName();
  public function insert();
  public function update();
  public function delete();
  public function getOne($id);
  public function getAll();
}
