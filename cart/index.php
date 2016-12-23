<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/theme/functions.php';
if (!is_logged_in()) {
  header("Location: " . $home_url . "/user/login.php");
  die();
}
if (isset($_GET['product_id']) && $_GET['task'] == 'add'):
  require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/theme/header.php';
?>
<?php
elseif (empty($_GET)):
require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/theme/header.php';
?>
<?php
else:
  require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/404.php';
endif;
 ?>
