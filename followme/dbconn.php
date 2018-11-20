<?php
  // Setting up the Database Connection
  $db_host = 'localhost';
  $db_user = 'php_hessercan_com';
  $db_password = '%qeRD$!Zy27k';
  $db_name = 'php_hessercan_com';

  $conn = new mysqli($db_host,$db_user,$db_password,$db_name);
  if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
  }

?>
