<?php session_start();
if(isset($_SESSION['username'])){
  echo "You are logged in as $_SESSION['username']";
} else {
  echo "You are logged out";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

  </body>
</html>
