<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/user/user.php';

if (is_logged_in())
  {
    if (isset($_POST['email'])&& isset($_POST['firstname']) 
			&& isset($_POST['lastname'])
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
    $result = $user->updateUser($_POST['email'],$_POST['oldpassword'],$user_data);
	header("Location: " . $home_url . "/settings");

	}
	else
	{
	$user = new user();
	$user_data = $user->getDataByEmail($_SESSION['email']);
	foreach ($user_data as $index => $d):
    require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/theme/header.php';
    ?>
  <form class="col-md-push-3 col-md-5 col-sm-12" action="" method="post">
    <div class="form-group">
      <label for="Firstname">Firstname</label>
      <input type="text" name="firstname" class="form-control" id="Firstname" 
			value=<?php echo $d['FirstName'];?> required="required">
    </div>
    <div class="form-group">
      <label for="Lastname">Lastname</label>
      <input type="text" name="lastname" class="form-control" id="Lastname" 
			value=<?php echo $d['LastName'];?> required="required">
    </div>
	</br>
    <div class="form-group">
      <label for="Email">E-mail Address</label>
      <input type="email" name="email" class="form-control" id="Email" 
			value=<?php echo $d['Email'];?> required="required">
    </div>
	</br>

    <div class="form-group">
      <label for="OldPassword">Old Password</label>
      <input type="password" name="oldpassword" class="form-control" id="Password" 
			placeholder="Old Password"wd required="required">
    </div>
	    <div class="form-group">
      <label for="Password">New Password</label>
      <input type="password" name="password" class="form-control" id="Password" 
			placeholder="New Password" required="required">
    </div>
	</br>
    <div class="form-group">
      <label for="Address">Address</label>
      <input type="text" name="address" class="form-control" id="Address" 
			value=<?php echo $d['Address'];?> required="required">
    </div>
	</br>
    <div class="form-group">
      <label for="BankAccount">Bank Account No.</label>
      <input type="text" name="bankaccount" class="form-control" id="BankAccount" 
			value=<?php echo $d['BankAccountNo'];?>>
    </div>
	</br>
    <input class="btn btn-primary" type="submit" value="Update">
	<input class="btn btn-cancel" type="button" value="Cancel">

  </form>
  <?php endforeach;
  }
  }
 ?>
