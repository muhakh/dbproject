<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/functions.php';
require_once 'user.php';
  if (is_logged_in())
  {
    header("Location: " . $home_url . "/");
    die();
  }
  elseif (isset($_POST['email']) && isset($_POST['password'])
          && isset($_POST['firstname']) && isset($_POST['lastname'])
          && isset($_POST['address']) )
  {
    $user = new User();
    $user_data = array($_POST['firstname'],
                       $_POST['lastname'],
                       $_POST['email'],
                       $_POST['password'],
                       $_POST['address'],
                       $_POST['bankaccount']
                      );
    $result = $user->createNewUser($user_data);
    if($result[2] != null)
    {
      echo $result[2];
    }
    else
    {
      echo "Add new user successfully, Now go to <a href='".$home_url."/user/login.php'>login</a>";
    }
  }
  else
  {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
    ?>
  <form class="col-md-push-3 col-md-5 col-sm-12" action="" method="post">
    <div class="form-group">
      <label for="Firstname">Firstname</label>
      <input type="text" name="firstname" class="form-control" id="Firstname" placeholder="Firstname" required="required">
    </div>
    <div class="form-group">
      <label for="Lastname">Lastname</label>
      <input type="text" name="lastname" class="form-control" id="Lastname" placeholder="Lastname" required="required">
    </div>
    <div class="form-group">
      <label for="Email">E-mail Address</label>
      <input type="email" name="email" class="form-control" id="Email" placeholder="Email Address" required="required">
    </div>
    <div class="form-group">
      <label for="Password">Password</label>
      <input type="password" name="password" class="form-control" id="Password" placeholder="Password" required="required">
    </div>
    <div class="form-group">
      <label for="Address">Address</label>
      <input type="text" name="address" class="form-control" id="Address" placeholder="Address" required="required">
    </div>
    <div class="form-group">
      <label for="BankAccount">Bank Account No.</label>
      <input type="text" name="bankaccount" class="form-control" id="BankAccount" placeholder="Bank Account No.">
    </div>
    <input class="btn btn-primary" type="submit" value="Sign Up">
  </form>
<?php
  }
 ?>
