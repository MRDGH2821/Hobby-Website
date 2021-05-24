<?php

$db_user = "toor";
$db_pass = "YES";
$db_table = "registration";

$db = new PDO('mysql:host=localhost;'  . $db_table . ';charset=utf8', $db_user, $db_pass);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
