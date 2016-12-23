<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/includes/eunit.php';

class ProductUnit extends EUnit
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getData($id)
  {
    $query = new Query();
    $query->select(array("ID", "Name", "Description", "Price", "AvailableQuantitiy", "CompanyName"));
    $query->from(array('Product'));
    $query->join('INNER', 'Supplier', 'Product.SupplierID=Supplier.UserID');
    $query->where("ID" . ' = ' . $id);
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->getData();
  }
}
