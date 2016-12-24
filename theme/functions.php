<?php
session_start();
function is_logged_in()
{
  if(isset($_SESSION['email']) && $_SESSION['email'] != '')
  {
     return true;
  }
  else
  {
    return false;
  }
}
$home_url = 'http://127.0.0.1/dbproject'
?>
