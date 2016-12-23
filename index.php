<?php require_once 'theme/header.php';
require_once 'includes/elist.php';
require_once 'includes/pagination.php';
$products_list = new EList();
$page = isset($_GET["page"]) ? (int)$_GET['page'] : 1;
$offset = 12 * ($page-1);
$products = $products_list->getData(12, $offset, 'Product');
?>
<?php foreach ($products as $product):?>
<div class="col-md-3 product">
  <a href="product/?id=<?php echo $product['ID'];?>"><?php echo $product['Name'];?></a>
  <br>
  Price: <?php echo $product['Price'];?> $
  <br>
  Availability: <?php echo $product['AvailableQuantitiy']>0 ? "<span style='color:green'>Available</span>" : "<span style='color:red'>Out of stock";?>
</div>
<?php endforeach; ?>
<nav aria-label="Page navigation">
  <ul class="pagination">
<?php
$pagination = new EPagination();
$pagination->getPagesNumber(12, 'Product', 'ID');
$pages = $pagination->getPagesNumber(12, 'Product', 'ID');
for($i=1; $i <= $pages; $i++)
{
  $is_current = $i == $page ? 'class="active"' : null;
  ?>
    <li <?php echo $is_current; ?>><a href="<?php echo $home_url;?>/?page=<?php echo $i;?>"><?php echo $i;?></a></li>
<?php } ?>
      </ul>
    </nav>
    </div>
  </body>
</html>
