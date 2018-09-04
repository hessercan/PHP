<?php session_start() ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Noah Woods</title>
  </head>

<?php
$username = $_POST['username'];
$password = $_POST['password'];
 ?>

  <body>
    <form method="post" action="">
      <input type="text" name="username"  placeholder="username"> <br/>
      <input type="password" name="password" placeholder="password">
      <br>
      <input type="submit" value="Submit">
      </form>

<?php
if (isset($username) && isset($password)) {
  if ($username == "Noah" && $password = "noah") {
    $_SESSION['username'] = $username;
  }
}
echo "Logged in as: " . $_SESSION['username'];
 ?>

    </body>
</html>
