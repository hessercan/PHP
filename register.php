<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('dbconn.php');
    // if (isset($_POST['username'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $password = password_hash($password, PASSWORD_BCRYPT);
      //SQL statement to execute
      $sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";
      $conn->query($sql);
      $conn->close();
      header("Location: ./index.php");
  // }
}
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Register</title>
     <?php include('header.php') ?>
   </head>
   <body>
     <?php include('navbar.php') ?>
     <h2>Register for PHP!</h2>
  <form method="post" action="">
     <p>Username: <input type="text" name="username"></p>
     <p>Password: <input type="password" name="password"></p>
     <p style="align: center"><input type="submit"></p>
   </form>
   <?php include('footer.php') ?>
   </body>
 </html>
