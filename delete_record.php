<?php

require('config.php');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $query = 'DELETE FROM registration WHERE ID = :id ';
    $statement = $db->prepare($query);
    $statement->bindvalue(":id", $id);
    $success=$statement->execute();
    $statement->closeCursor();
}

$deleted = true;

include('form.php');
