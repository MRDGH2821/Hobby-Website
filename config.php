<?php

$dsn = 'mysql:host=localhost;dbname=hobby-site';
$db_user = "toor";
$db_pass = "YES";

try {
  $db = new PDO(  . $db_table . ';charset=utf8', $db_user, $db_pass);


}catch(PDOException $e)
{
  $error_message = "Database Error";
  $error_message .= $e->getMessage();
  echo $error_message;
  exit()
}


$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
