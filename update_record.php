<?php

require('config.php');

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$username = filter_input(INPUT_POST, 'username', FILTER_VALIDATE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_STRING);
$contact = filter_input(INPUT_POST, 'contact', FILTER_VALIDATE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_STRING);

if ($id) {
    $query = 'UPDATE registration
              SET username = :username, email = :email, contact=:contact, password=:password WHERE ID = :id';
    $statement = $db->prepare($query);
    $statement->bindvalue(':id', $id);
    $statement->bindvalue(':username', $username);
    $statement->bindvalue(':email', $email);
    $statement->bindvalue(':contact', $contact);
    $statement->bindvalue(':password', $password);

    $success=$statement->execute();

    $statement->closeCursor();
}

$updated = true;

include('form.php');
