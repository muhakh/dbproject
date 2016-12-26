<?php
require_once 'dbo.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/config.php';
/**
 * Retrieves the data from tables
 */
class EUnit
{
  protected $db;
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
    $this->db = new dbo($connection_data);
    $this->db->connect();
  }
  /**
   * Gets data from database
   * @param int     $range      Equals maximum number of selected records
   * @param string  $columns    Columns to select from users table
   * @param string  $condition  The conditions of selecting data
   * @param string  $table      The table to select data from
   */
  public function getData($whereArray, $table, $join=null, $select = array('*'))
  {
    $query = new Query();
    $query->select($select);
    $query->from(array($table));
    foreach ($whereArray as $key => $value)
    {
      $query->where($key . ' = ' . $value);
    }
    if($join != null)
    {
      $query->join($join['type'], $join['table'], $join['on']);
    }
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->getData();
  }
  public function insertData($table, $values = array(), $columns = array())
  {
    $query = new Query();
    $query->insert($table, $columns, $values);
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->is_succeed();
  }
  public function updateData($table, $setArray)
  {
    $query = new Query();
    $set = "";
    foreach ($setArray as $key => $value)
    {
      $set .= $key . ' = ' . $value . ' ';
    }
    $query->update($table, $set);
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->is_succeed();
  }
  public function removeData($table, $whereArray)
  {
    $query = new Query();
    $query->delete($table);
    foreach ($whereArray as $key => $value)
    {
      $query->where($key . ' = ' . $value);
    }
    $query->setQuery();
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    return $this->db->is_succeed();
  }
}
