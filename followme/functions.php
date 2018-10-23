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
?>
