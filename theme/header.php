<?php require_once 'functions.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>dbproject</title>
    <link rel="stylesheet" href="<?php echo $home_url;?>/assets/bootstrap.min.css" type='text/css' media='all' />
    <link rel="stylesheet" href="<?php echo $home_url;?>/assets/style.css" type='text/css' media='all' />

  <script type='text/javascript' src='<?php echo $home_url;?>/assets/jquery.js'></script>
  <script type='text/javascript' src='<?php echo $home_url;?>/assets/bootstrap.min.js'></script>
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $home_url;?>">dbproject</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if(!is_logged_in()):?>
        <li><a href="<?php echo $home_url;?>/user/login.php">Login</a></li>
        <li><a href="<?php echo $home_url;?>/user/signup.php">Sign Up</a></li>
      <?php else:?>
        <li><a href="<?php echo $home_url;?>/cart">Cart</a></li>
        <li><a href="<?php echo $home_url;?>/order">Orders</a></li>
        <li><a href="<?php echo $home_url;?>/settings">Settings</a></li>
      <?php endif; ?>
      </ul>
      <form class="navbar-form navbar-right" action="<?php echo $home_url;?>/search.php" method="post">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
