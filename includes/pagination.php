<?php
require_once 'dbo.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dbproject/config.php';
/**
 * Retrieves the data from tables
 */
class EPagination
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
    $this->db = new dbo($connection_data);
    $this->db->connect();
  }
  public function getPagesNumber($range, $table, $id)
  {
    $query = new Query();
    $query->full_query('select count('. $id .') from '.$table.';');
    $this->db->setQuery($query->getQuery());
    $this->db->execute();
    $count = $this->db->getData()[0];
    $pages_number = (int)((int)$count["count(".$id.")"] / $range) + 1;
    return $pages_number;
  }
}
