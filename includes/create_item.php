<?php
require_once 'db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/e-commerce/config.php';
/**
 * Retrieves the data from tables
 */
class CreateItem
{
  protected $db;
  protected $query;
  /**
   * EUserModelList constructor
   * @param $db -> PDO database object
   */
  public function __construct($table, $columns = array(), $values)
  {
    $connection_data = array(
                                'host'     => DB_HOST,
                                'username' => DB_USER,
                                'password' => DB_PASSWORD,
                                'dbname'   => DB_NAME
                               );
    $this->db = new db($connection_data);
    $this->db->connect();
    $query = new Query();
    $query->insert($table, $columns, $values);
    $query->setQuery();
    $db->setQuery();
    $db->execute();
  }

 ?>