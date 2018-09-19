<?php
if (!isset($_SESSION)){
  session_start();
}

if(!isset($_SESSION['username'])){
  header('Location: ./login.php');
}

if (isset($_POST['logout'])){
  unset($_SESSION['username']);
  header("Location: ./index.php");
}

//Debug Code for File Upload
// var_dump($_FILES['upload']);
// echo "<hr />";
// var_dump($_POST['upload']);
// echo "<hr />";


if (isset($_FILES['upload'])){
  $target_dir = "./uploads/" . $_SESSION['username'] . "/";
  // if(!file_exists("uploads")){
  //   mkdir("uploads");
  // }

  if (!file_exists($target_dir)){
    mkdir($target_dir, 0775, true);
  }


  //echo $target_dir . "<br>";
  $target_file = $target_dir . basename($_FILES['upload']['name']);
  //echo $target_file . "<br>";
  $uploadOk = true;

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists. ";
      $uploadOk = false;
  }

  // Allow certain file formats
  $file_type = $_FILES['upload']['type'];
  switch ($file_type) {
    case 'image/jpeg':
      $uploadOk = true;
      break;
    case 'image/png':
      $uploadOk = true;
      break;
    case 'image/gif':
      $uploadOk = true;
      break;
    case 'application/pdf':
      $uploadOk = true;
      break;
    default:
      $uploadOk = false;
      $ret = "Sorry, Only jpeg, png, gif, and pdf allowed.";
  }

  if ($uploadOk) {
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
  // if everything is ok, try to upload file
  } else {
      echo "Sorry, your file was not uploaded. ";
  }
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
    <form class="" method="post" enctype="multipart/form-data">
      <input type="file" name="upload"><br />
      <input type="submit">
      <br />
      <br />
      <input type="submit" name="logout" value="Logout">

    </form>
    <h4 style="color:red;"><?php if ($ret) { echo $ret; } ?></h4>
  </body>
</html>
