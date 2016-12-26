<h1>Your Cart</h1>
<table class="table">
    <thead>
      <td>#</td>
      <td>Cart Item</td>
      <td>Quantity</td>
      <td>Actions</td>
    </thead>
<?php
$cart = new CartItems();
$cart_items = $cart->getData($_SESSION['email']);
foreach ($cart_items as $index => $item):
?>
<tr>
  <td><?php echo $index+1;?></td>
  <td><?php echo $item['Name'];?></td>
  <td><?php echo $item['Quantity'];?></td>
  <td>
    <a style="color:red" href="<?php echo $home_url;?>/cart/?task=remove&product_id=<?php echo $item['ID'];?>">Remove</a>
  </td>
</tr>
<?php endforeach;?>
<tfoot>
  <td><a class="add_to_cart" href="<?php echo $home_url;?>/order/?task=checkout">Checkout Order</a></td>
  <td></td>
  <td></td>
  <td></td>
</tfoot>
</table>
