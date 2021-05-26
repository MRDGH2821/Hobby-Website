<?php
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
    $contact =filter_input(INPUT_POST, "contact", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <link rel="stylesheet" type="text/css" href="signup.css" media="screen" />

  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <script type="text/javascript" src="password-validation.js"></script>
  </head>

  <body style="background-color:#E9E5D0;">
<main>
  <header>
    <h1 align='center'> Sign up Form </h1>
  </header>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

<?php

  if (isset($deleted)) {
      echo "Record Deleted.<br><br>";
  } elseif (isset($updated)) {
      echo "Record updated.<br><br>";
  } ?>

<?php if (!$username) { ?>
      <label for="username">Username: </label><br>
      <input type="text" id="username" name="username" required><br>


      <label for="email">Email: </label><br>
      <input type="email" name="email" id="email" required value /> <br>

      <label for="phno">Contact Number: </label><br>
      <input type="tel" name="contact" id="contact" pattern="^\d{10}$" required title="Must be 10 digits" /><br>

      <label for="password">Password: </label><br>
      <input type="password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{11,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 11 or more characters" required /> <br />
      <br>
      <input type="submit" value="Submit">
    </form>
<?php } else { ?>
<?php require("config.php"); ?>
<?php if ($username) {
      $query = "INSERT INTO registration
                        (username, email, contact, password)
                    VALUES
                        (:username,:email,:contact, :password)";
      $statement = $db->prepare($query);
      $statement->bindvalue(':username', $username);
      $statement->bindvalue(':email', $email);
      $statement->bindvalue(':contact', $contact);
      $statement->bindvalue(':password', $password);
      $statement->execute();
      $statement->closeCursor();
  } ?>
<?php
if ($username) {
      $query = 'SELECT * FROM registration WHERE Name = :username';
      $statement = $db->prepare($query);
      $statement->bindvalue(':username', $username);
      $statement->execute();
      $results = $statement->fetchAll();
      $statement->closeCursor();
  } ?>
<?php if (!empty($results)) {?>

  <section>
    <h2> Update or Delete Data</h2>
    <?php foreach ($results as $result) {
      $id=$result['ID'];
      $username = $result['username'];
      $email = $result['email'];
      $contact = $result['contact'];
      $password=$result['password'];
  }
?>
<form class="update" action="update_record.php" method="POST">
  <input type="hidden" name = "id" value="<?php echo $id ?>">
  <label for="username -<?php echo $id ?>"Username: </label>
  <input type="text" id="username-<?php echo $id ?>" name="username" value ="<?php echo $username ?>" required>

  <label for="email -<?php echo $id ?>"email: </label>
  <input type="text" id="email-<?php echo $id ?>" name="email" value ="<?php echo $email ?>" required>

  <label for="contact -<?php echo $id ?>"contact: </label>
  <input type="text" id="contact-<?php echo $id ?>" name="contact" value ="<?php echo $contact ?>" required>

  <label for="password -<?php echo $id ?>"password: </label>
  <input type="text" id="password-<?php echo $id ?>" name="password" value ="<?php echo $password ?>" required>

<button> update</button>
</form>
<form class="delete" action="delete_record.php" method="POST">
  <input type="hidden" name = "id" value="<?php echo $id ?>">
  <button class="red">Delete</button>
</form>
</section>
<?php }?>
  <a href="<?php echo $_SERVER['PHP_SELF']?>">Go to Signup page</a>
<?php }?>
    <div id="message">
      <h3>Password must contain the following:</h3>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>


    <h2> Site map</h2>
    <p><a href="index.html"> Main Page</a></p>
    <p><a href="tag_demos.html">Tags demo</a></p>
    <p><a href="form.php">Signup page</a></p>
</main>
  </body>

</html>
