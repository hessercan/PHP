<?php
  // Setting up the Database Connection
  $db_host = 'localhost';
  $db_user = 'phpuser';
  $db_password = 'Snapon21!';
  $db_name = 'phpdb';

  $conn = new mysqli($db_host,$db_user,$db_password,$db_name);
  if ($conn->connection_error) {
    die("Connection Failed: ") . $conn->connect_error);
  }
  else {
    echo "Success";
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    Success!
  </body>
</html>
