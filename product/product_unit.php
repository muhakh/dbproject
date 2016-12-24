<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/includes/eunit.php';

class ProductUnit extends EUnit
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getData($id)
  {
    $select = array("ID", "Name", "Description", "Price", "AvailableQuantitiy", "CompanyName");
    $table = 'Product';
    $where = array('ID' => $id);
    $join = array('type' => 'INNER', 'table' => 'Supplier', 'on' => 'Product.SupplierID=Supplier.UserID');
    return parent::getData($where, $table, $join, $select);
  }
}
