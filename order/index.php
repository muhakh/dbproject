<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/functions.php';
require_once 'order_items.php';
require_once '../cart/cart_items.php';
if (!is_logged_in()) {
  header("Location: " . $home_url . "/user/login.php");
  die();
}
if (isset($_GET['task'])):
  require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
  $order = new OrderItems();
  if($_GET['task'] == 'checkout')
  {
    $cart = new CartItems();
    $cart_items = $cart->getData($_SESSION['email']);
    echo "<h1>Your cart items:</h1><ul>";
    $price = 0;
    foreach ($cart_items as $index => $item)
    {
      echo "<li>" . $item['Name'] . " [" . $item['Quantity'] . " pieces]</li>";
      $price += $item['Quantity'] * $item['Price'];
    }
    echo "</ul>";
    require_once 'new_order.php';
  }
  elseif ($_GET['task'] == 'remove')
  {
    $c = $cart->removeItem($_GET['product_id'], $_SESSION['email']);
    if($c[2] == null)
      $success = "Item deleted successfully";
    else
      $success = $c[2];
  }
?>
<?php
elseif (empty($_GET)):
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
require_once 'full_orders.php';
else:
  require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/404.php';
endif;
 ?>
