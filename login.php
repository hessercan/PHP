<?php
session_start();
require('dbconn.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

<?php
$username = $_POST['username'];
$password = $_POST['password'];

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
    <p style="align: center"><input type="submit" value="login"></p>
    <input type="submit" name="logout" value="logout">
    </form>

    <?php
      if(isset($username) && isset($password)) {
        if($username == "mark" && $password == "snapon21") {
          $_SESSION['username'] = $username;
        }
      }

      echo "Logged in as: " . $_SESSION['username'];
     ?>

  </body>
</html>
