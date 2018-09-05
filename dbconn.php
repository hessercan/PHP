<?php
  // Setting up the Database Connection
  $db_host = 'localhost';
  $db_user = 'phpuser';
  $db_password = 'snapon21';
  $db_name = 'php';

  $conn = new mysqli($db_host,$db_user,$db_password,$db_name);
  if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
  }

?>
