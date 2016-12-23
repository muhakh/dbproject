<?php
require_once 'db.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/config.php';
/**
 * Retrieves the data from tables
 */
class EList
{
  private $db;
  /**
   * EUserModelList constructor
   * @param $db -> PDO database object
   */
  public function __construct()
  {
    $connection_data = array(
                                'host'     => DB_HOST,
                                'username' => DB_USER,
                                'password' => DB_PASSWORD,
                                'dbname'   => DB_NAME
                               );
    $this->db = new db($connection_data);
    $this->db->connect();
  }
  /**
   * Gets data from database
   * @param int     $range      Equals maximum number of selected records
   * @param string  $columns    Columns to select from users table
   * @param string  $condition  The conditions of selecting data
   * @param string  $table      The table to select data from
   */
  public function getData($range, $offset, $table)
  {
    $query = new Query();
    $query->select();
    $query->limit($range);
    $query->offset($offset);
    $query->from(array($table));
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->getData();
  }
}
