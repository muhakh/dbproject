<?php
require_once 'config.php';

$pdo_dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;
$db = new PDO($pdo_dsn, DB_USER, DB_PASSWORD);
?>
