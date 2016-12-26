<h1>Your Orders</h1>
<table class="table">
    <thead>
      <td>Order number</td>
      <td>Date</td>
      <td>Status</td>
    </thead>
<?php
$order = new OrderItems();
$order_items = $order->getOrders($_SESSION['email']);
var_dump($order);
foreach ($order_items as $index => $item):
?>
<tr>
  <td><?php echo $item['ID'];?></td>
  <td><?php echo $item['OrderDate'];?></td>
  <td><?php echo $item['Status'];?></td>
</tr>
<?php endforeach;?>
</table>
