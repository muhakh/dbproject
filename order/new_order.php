<?php if (isset($_POST['submit'])):
  $order_data = array('s_name' => $_POST['s_name'],
                      's_address' => $_POST['s_address'],
                      's_phone' => $_POST['s_phone'],
                      'status' => 'Delivered',
                      'user_email' => $_SESSION['email'],
                      'price' => $price
                     );
  $order_id = $order->createNewOrder($order_data);
  if($order_id)
  {
    foreach ($cart_items as $index => $item)
    {
      $order_item_data = array('order_id' => $order_id[0], 'quantity' => $item['Quantity'], 'product_id' => $item['ID']);
      $order->createOrderItem($order_item_data);
      $cart->removeItem($item['ID'], $item['UserID']);
      $order->subtractBalance($item['UserID'], $item['Price']);
    }
    echo "Order Succeded, <a href='".$home_url."/'>Continue Shopping</a>";
  }
  else
    {
      echo "Not enough balance";
    }
    ?>
  <?php endif; ?>
<h2>Total: <?php echo $price; ?> $</h2>
<form class="col-md-5 col-sm-12" action="" method="post">
  <div class="form-group">
    <label for="S_Name">Shipping Name</label>
    <input type="text" name="s_name" class="form-control" id="S_Name" placeholder="Shipping Name" required="required">
  </div>
  <div class="form-group">
    <label for="S_Address">Shipping Address</label>
    <input type="text" name="s_address" class="form-control" id="S_Address" placeholder="Shipping Address" required="required">
  </div>
  <div class="form-group">
    <label for="Phone">Shipping Phone</label>
    <input type="tel" name="s_phone" class="form-control" id="Phone" placeholder="Phone" required="required">
  </div>
  <input class="btn btn-primary" name="submit" type="submit" value="Complete Order">
  <input class="btn btn-danger" name="cancel" type="submit" value="Cancel Order">
</form>
