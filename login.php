<?php
include('functions.php');

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
    if ($username == $row['username'] && password_verify($password, $row['password'])) {
      $_SESSION['username'] = $row['username'];
      //header("Location: ./upload.php");
    }
  }
}
if (isset($_GET['logout'])) {
  logoutUser();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $_SESSION['title'] = "Login"; head(); ?>
  </head>

  <body>
    <?php navbar(); ?>

    <div class="login">
      <table border="0" style="margin:auto;">
      <form method="post" action="">
    <tr>
        <td style="width: 100px; text-align: right;">Username: </td>
        <td style="width:200px; text-align: left;"><input type="text" name="username" placeholder="Enter Username"></td>
    </tr>
    <tr>
        <td style="text-align: right;">Password:</td>
        <td style="text-align: left;"><input type="password" name="password" ></td>
      </tr>
      <tr style="height: 50px;">
        <td colspan="2" style="text-align: center;">
      <input style="width: 100px; height: 2em; margin: 0 auto;" type="submit" name="login" value="Login">
    </td>
    </tr>

      </form>
    </table>
    </div>
  </body>
</html>
