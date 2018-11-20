<?php
if (!isset($_SESSION)){
  session_start();
}



if (isset($_GET['logout'])) {
    logoutUser();
}

$_SESSION['title'] = "PHP";

?>

<?php

function logoutUser() {
  unset($_SESSION['email']);
  unset($_SESSION['first_name']);
  unset($_SESSION['last_name']);
  unset($_SESSION['image_url']);
  unset($_SESSION['description']);
  unset($_SESSION['user_title']);
  header("Location: ./login.php");
}
function checkLoginStatus() {
  if (!isset($_SESSION['email'])){
    header('Location: ./login.php');
  }
}

function updateProfile(){
  require('dbconn.php');
  $user_email = $_SESSION['email'];
  $sql = "SELECT email,first_name,last_name,user_title,description FROM fm_users WHERE email = '$user_email'";
  $result = $conn->query($sql);

  while ($row = $result->fetch_assoc()) {
    if ($user_email = $row['email']){
      $old_first_name = $row['first_name'];
      $old_last_name = $row['last_name'];
      $old_user_title = $row['user_title'];
      $old_description = $row['description'];
  }
}
  if (isset($_POST['first_name']) && !empty($_POST["first_name"])) {
    $first_name = $_POST['first_name'];
  } else {
    $first_name = $old_first_name;
  }
  if (isset($_POST['last_name']) && !empty($_POST["last_name"])) {
    $last_name = $_POST['last_name'];
  } else {
    $last_name = $old_last_name;
  }
  if (isset($_POST['user_title']) && !empty($_POST["user_title"])) {
    $user_title = $_POST['user_title'];
  } else {
    $user_title = $old_user_title;
  }
  if (isset($_POST['description']) && !empty($_POST["description"])) {
    $description = $_POST['description'];
  } else {
    $description = $old_description;
  }

  $sql = "UPDATE fm_users SET first_name='$first_name', last_name='$last_name', user_title='$user_title', description='$description' WHERE email='$user_email'";
  $result = $conn->query($sql);

}

function uploadProfilePic() {
    require('dbconn.php');
    $user_email = $_SESSION['email'];
    $target_email = str_replace("@", "_", $_SESSION['email']);
    $target_dir = "../profile-pics/" . $target_email . "/";
    $ret = "";
    // if(!file_exists("uploads")){
    //   mkdir("uploads");
    // }

    if (!file_exists($target_dir)){
      mkdir($target_dir, 0775, true);
    }


    //echo $target_dir . "<br>";
    $target_file = $target_dir . basename($_FILES['profile-pic']['name']);
    //echo $target_file . "<br>";
    $uploadOk = true;
    $uploadType = 0;

    // Check if file already exists
    if (file_exists($target_file)) {

    }

    // Allow certain file formats
    $file_type = $_FILES['profile-pic']['type'];
    switch ($file_type) {
      case 'image/jpeg':
        $uploadOk = true;
        $uploadType = 1;
        break;
      case 'image/png':
        $uploadOk = true;
        $uploadType = 2;
        break;

      default:
        $uploadOk = false;
        $uploadType = 0;
        $ret = "Sorry, Only jpeg or png allowed.";
    }

    if ($uploadOk) {
      switch ($uploadType) {
        case '1':
          $fileName = 'profile.jpeg';
          break;
        case '2':
          $fileName = 'profile.png';
          break;
        default:
          break;
      }
      $target_file = $target_dir . $fileName;
      if (move_uploaded_file($_FILES["profile-pic"]["tmp_name"], $target_file)) {
          $ret = "The file ". $fileName . " has been uploaded.";
          $sql = "UPDATE fm_users SET image_url='$target_file' WHERE email='$user_email'";
          $conn->query($sql);
      } else {
          $ret = "Sorry, there was an error uploading your file.";
      }
    // if everything is ok, try to upload file
    } else {
        $ret = "Sorry, your file was not uploaded. ";
    }

    $_SESSION['ret'] = $ret;
  }

function reloadSession(){

  require('dbconn.php');
  $user_email = $_SESSION['email'];
  $sql = "SELECT email,first_name,last_name,user_title,description,image_url FROM fm_users WHERE email = '$user_email'";
  $result = $conn->query($sql);

  //Extraction the returned query information
  while ($row = $result->fetch_assoc()) {
    if ($user_email == $row['email']){
      $_SESSION['first_name'] = $row['first_name'];
      $_SESSION['last_name'] = $row['last_name'];
      $_SESSION['description'] = $row['description'];
      $_SESSION['user_title'] = $row['user_title'];
      $_SESSION['image_url'] = $row['image_url'];
    }
    header("Location: ./profile.php");
    }
  }

?>
