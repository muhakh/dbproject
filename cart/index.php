<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/functions.php';
require_once 'cart_items.php';
if (!is_logged_in()) {
  header("Location: " . $home_url . "/user/login.php");
  die();
}
if (isset($_GET['product_id'])):
  require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
  $cart = new CartItems();
  $success = "";
  if($_GET['task'] == 'add')
  {
    $c = $cart->createNewItem($_GET['product_id'], $_SESSION['email'], $_GET['quantity']);
    if(is_array($c))
      $success = $c[2];
    else
      $success = "New Item Added successfully";
  }
  elseif ($_GET['task'] == 'remove')
  {
    $c = $cart->removeItem($_GET['product_id'], $_SESSION['email']);
    if(is_array($c))
      $success = $c[2];
    else
      $success = "Item deleted successfully";
  }
  echo "<h1>" . $success ."</h1>";
  require_once 'full_cart.php';
?>
<?php
elseif (empty($_GET)):
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
require_once 'full_cart.php';
else:
  require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/404.php';
endif;
 ?>
