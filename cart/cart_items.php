<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/includes/eunit.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/user/user.php';
class CartItems extends Eunit
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getData($user_email)
  {
    $select = array("Product.Name", "CartItem.Quantity", "Product.ID");
    $from = array('User');
    $where = array('User.Email' => $user_email);
    $query = new Query();
    $query->select($select);
    $query->from($from);
    $query->where('User.Email = "' . $user_email . '"');
    $query->join('INNER', 'CartItem', 'User.ID=CartItem.UserID');
    $query->join('INNER', 'Product', 'CartItem.ProductID = Product.ID');
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->getData();
  }
  public function getSingleItem($product_id, $user_id)
  {
    return parent::getData(array('ProductID' => $product_id, 'UserID' => $user_id), 'CartItem');
  }
  public function createNewItem($product_id, $user_email, $quantity)
  {
    $user = new User();
    $user_id = $user->getDataByEmail($user_email)[0]['ID'];
    $p = $this->getSingleItem($product_id, $user_id);
    if(empty($p))
    {
      $cols = array('UserID',
                    'ProductID',
                    'Quantity',
                    );
      $values = array($user_id, $product_id, $quantity);
      return parent::insertData('CartItem', $values, $cols);
    }
    else
    {
      $q = $p[0]['Quantity'] + $quantity;
      return parent::updateData('CartItem', array('Quantity' => $q));
    }
  }
  public function removeItem($id, $user_email)
  {
    $user = new User();
    $user_id = $user->getDataByEmail($user_email)[0]['ID'];
    return parent::removeData('CartItem', array('ProductID'=>$id, 'UserID'=> $user_id));
  }
}
