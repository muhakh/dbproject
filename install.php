<?php
require_once 'pdo.php';
require_once 'split_queries.php';
$sql_file = fopen("db.sql", "r") or die("Unable to open SQL file!");
$queries = splitQueries(fread($sql_file,filesize("db.sql")));
foreach ($queries as $query)
{
  try
  {
    $db->query(trim($query));
    echo "Query executed successfully\n";
  }
  catch (PDOException $e)
  {
    throw $e;
  }
}
fclose($sql_file);
?>
