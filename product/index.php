<?php
if (isset($_GET['id'])):
require_once 'product_unit.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/theme/header.php';
$home_url = $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/'
?>
<?php
$product_object = new ProductUnit();
$product = $product_object->getData($_GET['id'])[0];
 ?>
 <form action="../cart/" method="get" onsubmit="return check_quantity(document.getElementById('quantity'))">
<h1><?php echo ucfirst($product["Name"]); ?></h1>
<ul>
<li><strong>Description:</strong> <?php echo ucfirst($product["Description"]); ?></li>
<li><strong>Price:</strong> <?php echo $product["Price"]; ?> $</li>
<li><strong>Status:</strong> <?php echo $product['AvailableQuantitiy']>0 ? "<span style='color:green'>Available</span>" : "<span style='color:red'>Out of stock";?></li>
<li><strong>Vendor:</strong> <?php echo $product["CompanyName"];?></li>
<li><strong>Quantity:</strong> <input id="quantity" type="number" name="quantity" min="0" value="0">
</ul>
<input type="hidden" name="task" value="add">
<input type="hidden" name="product_id" value="<?php echo $product['ID'];?>">
<div class="col-md-4">
  <input type="submit" value="Add to cart">
</form>
</div>
</div>
<script type="text/javascript">
function check_quantity(field) {
  if (field.value == '0') {
      alert("You need to add the quantity of the product you need.");
      return false;
  }
  return true;
}
</script>
</body>
</html>
<?php
else:
  require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/404.php';
endif;
?>
