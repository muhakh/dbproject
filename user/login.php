<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/functions.php';
require_once 'user.php';
  if (is_logged_in())
  {
    header("Location: " . $home_url . "/");
    die();
  }
  elseif (isset($_POST['email']) && isset($_POST['password']))
  {
    $user = new User();
    $login_check = $user->checkLogin($_POST['email'], $_POST['password']);
    if($login_check)
    {
      if (session_status() == PHP_SESSION_NONE)
        session_start();
      $_SESSION['email'] = $login_check;
      header("Location: " . $home_url . "/");
      die();
    }
    else
    {
      require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
      ?>
    <form class="col-md-push-3 col-md-5 col-sm-12" action="" method="post">
      <div class="form-group">
      <h3 style="color:red">E-mail Address or Password is wrong</h3>
      <label for="Email">E-mail Address</label>
      <input type="email" name="email" class="form-control" id="Email" placeholder="Email Address" required="required">
    </div>
    <div class="form-group">
      <label for="Password">Password</label>
      <input type="password" name="password" class="form-control" id="Password" placeholder="Password" required="required">
    </div>
      <input class="btn btn-primary" type="submit" value="Login">
    </form>
    <?php
    }
  }
  else
  {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
    ?>
  <form class="col-md-push-3 col-md-5 col-sm-12" action="" method="post">
    <div class="form-group">
    <label for="Email">E-mail Address</label>
    <input type="email" name="email" class="form-control" id="Email" placeholder="Email Address" required="required">
  </div>
  <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" name="password" class="form-control" id="Password" placeholder="Password" required="required">
  </div>
    <input class="btn btn-primary" type="submit" value="Login">
  </form>
<?php
  }
 ?>
