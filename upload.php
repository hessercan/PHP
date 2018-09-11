<?php
if (!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['username'])){
  header('login.php');
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload</title>
  </head>
  <body>
    Upload your File.
    <form class="" action="upload.html" method="post" enctype="multipart/form-data">
      <input type="file" name="upload">
    </form>
  </body>
</html>
