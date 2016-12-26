<?php
require_once 'query.php';
class dbo
{
  private $connection = array(
                              'host'     => '',
                              'username' => '',
                              'password' => '',
                              'dbname'   => ''
                             );
  private $pdo;
  private $query;
  private $data = null;
  private $execute_return = null;
  /**
   * Database class constructor
   * @param array $connection_data contains connection data
   */
  public function __construct($connection_data)
  {
    foreach ($connection_data as $key => $value)
    {
      $this->connection[$key] = $value;
    }
  }

  public function connect()
  {
    $pdo_dsn = 'mysql:host='.$this->connection['host'].';dbname='.$this->connection['dbname'].';charset=utf8';
    $this->pdo = new PDO($pdo_dsn, $this->connection['username'], $this->connection['password']);
  }
  public function setQuery($query)
  {
    $this->query = $query;
  }
  public function execute()
  {
    $q = $this->pdo->prepare($this->query);
    $q->execute();
    $this->execute_return = $q->errorInfo();
    $this->data = $q->fetchAll(PDO::FETCH_ASSOC);
    if($this->execute_return[2] != null)
      return $this->is_succeed();
    else
      return $this->pdo->lastInsertId();
  }
  public function getData()
  {
    return $this->data;
  }
  public function is_succeed()
  {
    return $this->execute_return;
  }
}
?>
