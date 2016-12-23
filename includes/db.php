<?php
require_once 'query.php';
class db
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
    $this->data = $q->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getData()
  {
    return $this->data;
  }
}
?>
