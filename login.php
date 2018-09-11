<?php
if (!isset($_SESSION)){
  session_start();
}
require('dbconn.php');

if (isset($_POST['username'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  //SQL statement to execute
  $sql = "SELECT username, password FROM users where username = '$username'";

  //Execute the SQL and return array to $result
  $result = $conn->query($sql);

  //Extraction the returned query information
  while ($row = $result->fetch_assoc()) {
    if ($username == $row['username'] && password_verify($password, $row['password']) {
      $_SESSION['username'] = $username;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>

<?php

if (isset($_POST['logout'])){
  unset($_SESSION['username']);
}

?>

  <body>
    <form method="post" action="">
      <p>Username:
      <input type="text" name="username" placeholder="Enter Username"></p>
      <p>Password:
      <input type="password" name="password" ></p>
    <p style="align: center"><input type="submit" value="Login"></p>
    <input type="submit" name="logout" value="Logout">
    </form>
    <a href="./register.php">Register</a><br />

    <?php
      echo "Logged in as: " . $_SESSION['username'];
     ?>

  </body>
</html>
