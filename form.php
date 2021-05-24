<?php
require_once('config.php');
if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    $sql = "INSERT INTO registration (username,email,contact,password) VALUES (?,?,?,?)";
    $stmtinsert=$db->prepare($sql);
    $result=$stmtinsert->execute([$username,$email,$contact,$password]);
    if ($result) {
        echo 'Registered!';
    } else {
        echo 'Failed!';
    }
}
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

    <h1 align='center'> Sign up Form </h1>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" METHOD="GET">

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

  </body>

</html>
