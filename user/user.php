<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/includes/eunit.php';
class User extends EUnit
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getDataByID($id)
  {
    return parent::getData(array('ID' => $id), 'User');
  }
  public function getDataByEmail($email)
  {
    return parent::getData(array('Email' => '"'.$email.'"'), 'User');
  }
  public function checkLogin($email, $password)
  {
    $where = array('Email' => '"' . $email . '"', 'Password' => '"' . $password . '"');
    $data = parent::getData($where, 'User');
    if(empty($data))
    {
      return false;
    }
    else {
      return $data[0]["Email"];
    }
  }
  public function createNewUser($values)
  {
    $cols = array('FirstName',
                  'LastName',
                  'Email',
                  'Password',
                  'Address',
                  'BankAccountNo'
                  );
    return parent::insertData('User', $values, $cols);
  }
  public function createNewCustomer($user_id)
  {
    $cols = array('UserID',
                  'Balance',
                  );
    return parent::insertData('Customer', array($user_id, '0'), $cols);
  }
  public function updateUser($email,$password,$values)
  {
    $where = array('Email' => '"' . $email . '"', 'Password' => '"' . $password . '"');
	$setArray = array('FirstName' => '"'.$values[0].'"',
                  'LastName' => '"'.$values[1].'"',
                  'Email'=> '"'.$values[2].'"',
                  'Password'=> '"'.$values[3].'"',
                  'Address'=> '"'.$values[4].'"',
                  'BankAccountNo'=> '"'.$values[5].'"'
                  );
	return parent::updateData('User', $setArray, $where);
  }
  public function getCustomer($user_id)
  {
    return parent::getData(array('UserID'=>$user_id), 'Customer');
  }
}
