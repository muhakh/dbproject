<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/includes/create_item.php';

class CreateCartItem extends CreateItem
{
  public function __construct($values, $table  = 'CartItem', $columns = array())
  {
    parent::__construct($table, $columns, $values);
  }
}