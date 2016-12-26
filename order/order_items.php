<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/includes/eunit.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/user/user.php';
class OrderItems extends Eunit
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getData($user_email)
  {
    $select = array("User.ID", "Orders.ID", "Orders.OrderDate", "Product.Name", "OrderItem.Quantity");
    $from = array('User');
    $where = array('User.Email' => $user_email);
    $query = new Query();
    $query->select($select);
    $query->from($from);
    $query->where('User.Email = "' . $user_email . '"');
    $query->join('INNER', 'Orders', 'User.ID = Orders.UserID');
    $query->join('INNER', 'OrderItem', 'Orders.ID = OrderItem.OrderID');
    $query->join('INNER', 'Product', 'OrderItem.ProductID = Product.ID');
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->getData();
  }
  public function getOrders($user_email)
  {
    $select = array("Orders.ID", "Orders.OrderDate", "Orders.Status");
    $from = array('User');
    $where = array('User.Email' => $user_email);
    $query = new Query();
    $query->select($select);
    $query->from($from);
    $query->where('User.Email = "' . $user_email . '"');
    $query->join('INNER', 'Orders', 'User.ID = Orders.UserID');
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->getData();
  }
  public function getSingleItem($product_id, $order_id)
  {
    return parent::getData(array('ProductID' => $product_id, 'OrderID' => $user_id), 'OrderItem');
  }
  public function createNewOrder($data)
  {
    $user = new User();
    $user_id = $user->getDataByEmail($data['user_email'])[0]['ID'];
    $customer_balance = $user->getCustomer($user_id)[0]['Balance'];
    if($customer_balance < $data['price'])
    {
      return false;
    }
    $cols = array('UserID',
                  'OrderDate',
                  'Status',
                  'ShippingName',
                  'ShippingAddress',
                  'ShippingPhone'
                  );
    $now = date('Y-m-j H:i:s');
    $values = array($user_id, $now, $data['status'], $data['s_name'], $data['s_address'], $data['s_phone']);
    return parent::insertData('Orders', $values, $cols);
  }
  public function createOrderItem($data)
  {
    $cols = array('OrderID',
                  'ProductID',
                  'Quantity',
                  );
    $values = array($data['order_id'], $data['product_id'], $data['quantity']);
    return parent::insertData('OrderItem', $values, $cols);
  }
  public function subtractBalance($user_id, $price)
  {
    $user = new User();
    $customer_balance = $user->getCustomer($user_id)[0]['Balance'];
    $customer_balance -= $price;
    return parent::updateData('Customer', array('Balance' => $customer_balance), array('UserID'=>$user_id));
  }
}
